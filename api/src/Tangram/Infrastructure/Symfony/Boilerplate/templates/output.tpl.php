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
    echo output_import($use)."\n";
}
?>

final class <?= $class_name ?>  {

<?php
foreach ($fields as $name=> $type) {
    echo "\t" .output_property($name, $type)."\n";
}
?>

    public static function make(<?= $entity['shortName'] ?> $entity): self
    {
        return new self($entity);
    }

    private function __construct(<?= $entity['shortName'] ?> $entity){
<?php
foreach ($fields as $name=> $type) {
    echo "\t\t" .output_init_property($name, $type)."\n";
}
?>
    }
}

<?php
    function output_property($name, $type){

         if($type['nullable']){
             return sprintf('public ?%s $%s = null;', $type['shortName'], $name);
         }
         return sprintf('public %s $%s;', $type['shortName'], $name);
    }

    function output_init_property($name ){
        return sprintf('$this->%s = $entity->%s();', $name, $name);
    }

    function output_import($use){
        return sprintf('use %s;',  $use);
    }

?>
