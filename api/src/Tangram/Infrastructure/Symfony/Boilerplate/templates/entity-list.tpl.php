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

use Tangram\Domain\Lists\EntityList;

final class <?= $class_name ?>  extends EntityList{

    public function type(): string
    {
        return <?= $entity['shortName'] ?>::class;
    }

}
