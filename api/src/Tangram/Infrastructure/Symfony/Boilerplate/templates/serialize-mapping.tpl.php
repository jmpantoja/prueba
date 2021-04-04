<?= $output['fullName']?>:
    attributes:
<?php
foreach (array_keys($fields) as $field){
    echo serialize_attribute($field)."\n";
}

function serialize_attribute($field){
    $groups = "['write', 'read']";
    if($field === 'id'){
        $groups = "['read']";
    }

 return <<<eof
        $field:
             groups: $groups

eof;

}
