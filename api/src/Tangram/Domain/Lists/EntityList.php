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

abstract class EntityList extends TypedList
{
	public function add(int | string $key, $item): static
	{
		$key = (string) $item->id();

		return parent::add($key, $item);
	}
}
