--https://github.com/blacktaxi/oops
local class = require 'oops'
--local md5 = require("md5")
local redis = require "resty.redis"
local json = require 'cjson'

function trim(source)
    return string.gsub(source, "^%s*(.-)%s*$", "%1")
end

function split (source, delimiters)
    if not source then return {} end

    local items = {}
    local pattern = '([^'..delimiters..']+)'
    string.gsub(source, pattern, function(value)
        items[#items + 1] = trim(value);
    end);

    return items
end

function log(value, name)
    local type = type(value)
    name = name or ''
    value = value or '(null)'

    if type ~= 'string' then
        value = json.encode(value)
    end

    value = '\n\n\n >>> ' .. name .. '\n' .. value .. '\n\n\n'

    ngx.log(ngx.OK, value)
end



local mt = getmetatable("")
mt.__index["split"] = split
mt.__index["trim"] = trim



--
-- REDIS
--
local Redis = class {
    __init = function (self, config)
        self.host = config.host

        self.host= config.host or 'redis'
        self.port= config.port or 6379
        self.timeout= config.timeout or  5000
        self.database= config.database or 0
        self.max_idle_time= config.max_idle_time or  60000
        self.pool_size= config.pool_size or  100

    end,

    conn = function(self)
        local conn = redis:new()
        conn:set_timeout(self.timeout)

        local ok, err = conn:connect(self.host, self.port)
        if not ok then
            errlog("Cannot connect, host: " .. self.host .. ", port: " .. self.port)
            return nil, err
        end

        conn:select(self.database)
        return conn;
    end,

    exec = function(self, callback)
        local conn = self:conn()

        conn:init_pipeline()
        callback(conn)

        return self:finish(conn)

    end,

    finish = function(self, conn)
        res, err = conn:commit_pipeline()

        if not res then
            ngx.log(ngx.ERR, 'Algo anda mal con redis: ' .. err)
        end

        local ok, err = conn:set_keepalive(self.max_idle_time, self.pool_size)
        if not ok then
            conn:close()
        end
        return res, err
    end
}


--
-- CACHE-CONTROL
--
local CacheControl = class {
__init = function (self, line)
    line = line or ''
    local items = line:split(',')
    self.table = {}

    for _,item in pairs(items) do
       local key, value = self.parse(item)
       self.table[key] = value
    end

  end,

  parse = function(item)
    item = item:trim()

    local res = split(item, "=")
    local key = res[1]
    local value = res[2]

    if(key == 'public') then
        return key, true
    end
    return key, tonumber(value)
  end,

  is_public = function(self)
    return self.table.public
  end,


  get_ttl = function(self)
    if not self.is_public then
        return null
    end

    return self.table['s-maxage'] or 0
  end
}

--
-- REQUEST
--
local Request = class {
    __init = function (self, ngx)
        self.ngx = ngx
        self.method = ngx.req.get_method()
        self.headers = ngx.req.get_headers()
        self.uri = self.ngx.var.request_uri
        self.ext = self:get_ext()

        -- tags
    end,

    get_ext = function(self)
        local normalized = {}
        normalized['application/ld+json'] = 'jsonld'
        normalized['application/hal+json'] = 'jsonhal'
        normalized['application/vnd.api+json'] = 'jsonapi'
        normalized['application/json'] = 'json'
        normalized['application/xml'] = 'xml'
        normalized['text/xml'] = 'xml'
        normalized['application/x-yaml'] = 'yaml'
        normalized['text/csv'] = 'csv'
        normalized['text/html'] = 'html'
        normalized['application/vnd.ms-excel'] = 'xlsx'

        local types = (self.headers.accept or 'application/ld+json'):split(',');
        local content_type = null

        for _,type in pairs(types) do
            type = type:lower()
            content_type = content_type or normalized[type]
        end

        return content_type or ''
    end,

    key = function(self)
        return 'key:/' .. self.uri .. '.' .. self.ext
    end,

    tag_key = function(self)
        return self.uri
    end,

    is_ban = function(self)
        return self.method == 'BAN'
    end,

    is_get = function(self)
        return self.method == 'GET'
    end,

    pass = function(self)
        local ngx = self.ngx
        ngx.req.read_body()

        return ngx.location.capture('/index.php', {
            args= ngx.var.args,
            share_all_vars= true,
            always_forward_body= true,
            body= ngx.req.get_body_data()
        })
    end
}


--
-- BAN
--
local Ban = class {
    __init = function (self, redis, request)
        self.redis = redis
        self.request = request
    end,

    response = function(self)
        local redis = self.redis
        local tags = self.request.headers.ban_keys or {}
        if type(tags) == 'string' then
            tags = {tags}
        end

        for _,tag in pairs(tags) do
            self:ban_tag('tag:/'..tag)
        end

        return {
            header= {},
            body= 'ban',
            status= 200
        }
    end,

    ban_tag = function(self, tag)
        local redis = self.redis
        local keys = redis:exec(
            function (conn)
               return conn:smembers(tag)
            end
        )[1]

        redis:exec(
            function (conn)
               for _,key in pairs(keys) do
                conn:del(key)
               end

               conn:del(tag)
            end
        )
    end
}


--
-- HIT
--
local Hit = class {
    __init = function (self, redis, request)
        self.redis = redis
        self.request = request
    end,

    response = function(self)
        local redis = self.redis
        local key = self.request:key()

        local response = redis:exec(
            function(conn)
                return conn:get(key)
            end
        )

        response = json.decode(response[1])
        response.header['X-Cache'] = 'HIT'

        return response
    end
}

--
-- MISS
--
local Miss = class {
    __init = function (self, redis, request)
        self.redis = redis
        self.request = request
    end,

    response = function(self)
        local redis = self.redis
        local key = self.request:key()
        local tag_key = self.request:tag_key()
        local response = self.request:pass()

        local control = CacheControl(response.header['Cache-Control'])

        if not control:is_public() then
            response.header['X-Cache'] = 'BYPASS'
            return response
        end

        local tags = (response.header['Cache-Tags'] or tag_key):split(',')

        redis:exec(
            function(conn)
                conn:set(key, json.encode(response))
                conn:expire(key, control:get_ttl())

                for _,tag in pairs(tags) do
                    tag = 'tag:/'.. tag
                    conn:sadd(tag, key)
                end
            end
        )

        response.header['X-Cache'] = 'MISS'
        return response
    end
}

--
-- PASS
--
local Pass = class {
    __init = function (self, request)
        self.request = request
    end,

    response = function(self)
        return self.request:pass()
    end
}

--
-- CACHE
--
local ActionFactory = class {
    __init = function (self, redis)
        self.redis = redis
    end,

    exists = function(self, key)
        local redis = self.redis

        local res = redis:exec(
            function(conn)
                return conn:exists(key);
            end
        )
        return res[1] == 1

    end,

    get = function(self, request)
        local redis = self.redis


        if request:is_ban()
        then
            return Ban(redis, request)
        end

        local key = request:key()
        local key_exists = self:exists(key)

        if request:is_get() and key_exists
        then
            return Hit(redis, request)
        end


        if request:is_get() and not key_exists
        then
            return Miss(redis, request)
        end

        return Pass(request)

    end,

    response = function(self)
        return {
            headers= {},
            body= 'key =>' .. self.request:key(),
            status= 200
        }
    end
}



--
-- PROXY
--
local Proxy = class {
    __init = function (self, ngx)
        self.ngx = ngx

        local request = Request(self.ngx)
        local redis = Redis({
             host= os.getenv('REDIS') or 'redis',
        })

        local action = ActionFactory(redis):get(request)
        self.response = action:response()

        self:finish()
    end,

    finish = function (self)
        local response = self.response
        for name, value in pairs(response.header) do
            self.ngx.header[name] = value
        end

        self.ngx.say(response.body)
        self.ngx.exit(response.status)
    end

}

Proxy(ngx);


-- application/ld+json
-- application/hal+json
-- application/vnd.api+json
-- application/json
-- application/xml
-- text/xml
-- application/x-yaml
-- text/csv
-- text/html
-- application/vnd.ms-excel
