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

use Tangram\Infrastructure\Api\Dto\Input;

abstract class EntityList extends TypedList
{
	public function add(int|string $key, $item): static
	{
		$key = (string) $item->id();

		return parent::add($key, $item);
	}

	public function compareWith(iterable $values): DiffList
	{
		$input = MixedList::collect($values);
		$from = $this->mapKeys([$this, 'hash']);
		$input = $input->mapKeys([$this, 'hash']);

		return DiffList::compare($from, $input);
	}

	abstract public static function hash(Input $meaning): string;
}
