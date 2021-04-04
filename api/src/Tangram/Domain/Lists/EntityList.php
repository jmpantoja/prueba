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


use Tangram\Domain\Lists\Exception\InvalidCollectionElement;
use Tangram\Domain\Model\Entity;

abstract class EntityList extends TypedList
{

    protected function add(string|int $key, mixed $item): static
    {
        $item instanceof Entity || throw new InvalidCollectionElement($item, Entity::class);

        $key = (string)$item->id();
        return parent::add($key, $item);
    }

    public function diff(?EntityList $other = null): DiffList
    {
        $other = $other ?? static::collect();

        return DiffList::compare($this, $other);
    }


}
