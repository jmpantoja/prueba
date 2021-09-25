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

final class DiffList
{
	private array $other;
	private array $original;

	public function __construct(ListInterface $original, ListInterface $other)
	{
		$this->original = $original->toArray();
		$this->other = $other->toArray();
	}

	public static function compare(ListInterface $original, ListInterface $other): self
	{
		return new self($original, $other);
	}

	public function inserts(callable $callback): self
	{
		$inserts = array_diff_key($this->other, $this->original);
		foreach ($inserts as $item) {
			$callback($item);
		}

		return $this;
	}

	public function updates(callable $callback): self
	{
		$updates = array_intersect_key($this->other, $this->original);
		foreach ($updates as $key => $item) {
			$callback($this->original[$key], $item);
		}

		return $this;
	}

	public function removes(callable $callback): self
	{
		$removes = array_diff_key($this->original, $this->other);
		foreach ($removes as $item) {
			$callback($item);
		}

		return $this;
	}
}
