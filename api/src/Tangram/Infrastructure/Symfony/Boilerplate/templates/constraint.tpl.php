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

use Symfony\Component\Validator\Constraints\Compound;

final class <?= $class_name ?>  extends Compound{

    protected function getConstraints(array $options): array
    {
        return [];
    }
}
