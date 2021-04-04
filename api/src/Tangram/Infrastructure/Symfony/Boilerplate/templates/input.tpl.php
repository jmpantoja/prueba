<?= "<?php\n" ?>
/**
* This file is part of the planb project.
*
* (c) jmpantoja <jmpantoja@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

declare(strict_types=1);

namespace <?= $namespace; ?>;

<?php
foreach ($uses as $use) {
    echo input_import($use)."\n";
}
?>

final class <?= $class_name ?>  {

<?php
foreach ($fields as $name=> $type) {
    echo "\t" .input_property($name, $type)."\n";
}
?>
}
<?php
    function input_property($name, $type){

        if($name === 'id'){
            return null;
        }

         if($type['nullable']){
             return sprintf('public ?%s $%s = null;', $type['shortName'], $name);
         }
         return sprintf('public %s $%s;', $type['shortName'], $name);
    }

    function input_import($use){
        return sprintf('use %s;',  $use);
    }

?>
