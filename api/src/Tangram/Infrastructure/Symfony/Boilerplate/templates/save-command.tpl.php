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

use <?= $entity['fullName'] ?>;

final class <?= $class_name ?> {
    /**
    * @var <?= $entity['shortName'] ?>
    */
    private <?= $entity['shortName'] ?> $<?= $entity['varName'] ?>;

    /**
    * <?= $class_name ?> constructor.
    * @param <?= $entity['shortName'] ?> $<?= $entity['varName'] ."\n" ?>
    */
    public function __construct(<?= $entity['shortName'] ?> $<?= $entity['varName'] ?>)
    {
        $this-><?= $entity['varName']?> = $<?= $entity['varName']?>;
    }

    /**
    * @return <?= $entity['shortName'] ."\n"?>
    */
    public function <?= $entity['varName']?>(): <?= $entity['shortName'] ?>
    {
        return $this-><?= $entity['varName']?>;
    }
}
