<?=$input['fullName']?>:
    properties:
<?php
foreach ($fields as $name=> $type) {
    echo sprintf("\t\t%s: ~\n\n", $name);
}
?>
