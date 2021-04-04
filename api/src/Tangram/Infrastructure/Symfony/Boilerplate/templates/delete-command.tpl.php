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

namespace <?= $namespace ?>;

use <?= $entityId['fullName'] ?>;

final class <?= $class_name ?> {
    /**
    * @var <?= $entityId['shortName'] ."\n"?>
    */
    private <?= $entityId['shortName'] ?> $<?= $entityId['varName'] ?>;

    /**
    * <?= $class_name ?> constructor.
    * @param <?= $entityId['shortName'] ?> $<?= $entityId['varName'] ."\n"?>
    */
    public function __construct(<?= $entityId['shortName'] ?> $<?= $entityId['varName'] ?>)
    {
        $this-><?= $entityId['varName']?> = $<?= $entityId['varName']?>;
    }

    /**
    * @return <?= $entityId['shortName'] ."\n"?>
    */
    public function <?= $entityId['varName']?>(): <?= $entityId['shortName'] ?>
    {
        return $this-><?= $entityId['varName']?>;
    }
}
