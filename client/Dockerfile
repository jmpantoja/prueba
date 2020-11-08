FROM node:10-alpine as api_platform_client

# Create app directory
RUN mkdir -p /usr/app
WORKDIR /usr/app

## Install app dependencies
#COPY package.json /usr/app/
#COPY yarn.lock /usr/app/
#RUN yarn install

# Set environment variables
#ENV NODE_ENV production
ENV NUXT_HOST 0.0.0.0
ENV NUXT_PORT 3000

EXPOSE 3000

