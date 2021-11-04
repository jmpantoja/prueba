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

namespace Tangram\Infrastructure\Api\Dto;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;

abstract class Input implements IteratorAggregate, ArrayAccess
{
	public static function fromArray(array $data): static
	{
		$input = new static();
		foreach ($data as $key => $value) {
			$input->{$key} = $value;
		}

		return $input;
	}

	public function getIterator()
	{
		return new ArrayIterator(get_object_vars($this));
	}

	public function offsetExists($offset)
	{
		return isset($this->{$offset});
	}

	public function offsetGet($offset)
	{
		return $this->{$offset};
	}

	public function offsetSet($offset, $value)
	{
		$this->{$offset} = $value;
	}

	public function offsetUnset($offset)
	{
		unset($this->{$offset});
	}
}
