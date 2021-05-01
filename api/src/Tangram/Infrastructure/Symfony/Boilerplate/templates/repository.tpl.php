<?= "<?php\n" ?>
/**
* This file is part of the planb project.
*
* (c) jmpantoja
<jmpantoja@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

declare(strict_types=1);

namespace <?= $namespace; ?>;

interface <?= $class_name ?> {
public function save(<?= $entity['shortName'] ?> $<?= $entity['varName'] ?>);

public function delete(<?= $entityId['shortName'] ?> $<?= $entityId['varName'] ?>);

public function findById(<?= $entityId['shortName'] ?> $<?= $entityId['varName'] ?>): ?<?= $entity['shortName'] ?>;
}


