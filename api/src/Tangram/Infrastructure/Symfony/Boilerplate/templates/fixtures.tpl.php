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

use Tangram\Infrastructure\Doctrine\DataFixtures\UseCaseFixture;
use <?= $saveCommand['fullName']?>;
use <?= $entity['fullName']?>;

final class <?= $class_name ?> extends UseCaseFixture  {

    public function loadData(): void
    {
        $items = $this->createMany(100, function () {
            //return new <?= $entity['shortName']?>();
        });

        foreach ($items as $<?= $entity['varName']?>) {
            $this->handle(new <?= $saveCommand['shortName']?>($<?= $entity['varName']?>));
        }
    }
}
