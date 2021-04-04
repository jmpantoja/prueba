<?php

/**
 * This file is part of the planb project.
 *
 * (c) jmpantoja <jmpantoja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tangram\Domain\Lists;


final class MixedList extends AbstractList
{
    public static function collect(?iterable $input, string $type = null): self
    {
        return new self($input, $type);
    }
}
