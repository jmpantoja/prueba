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
use Tangram\Domain\Lists\Exception\NonExistentElement;
use Traversable;

abstract class AbstractList implements ListInterface
{
	private array $data = [];

	protected function __construct(?iterable $input = null, string $type = null)
	{
		$input = $input ?? [];
		if ($input instanceof Traversable) {
			$input = iterator_to_array($input);
		}

		foreach ($input as $key => $item) {
			$this->assert($item, $type) || throw new InvalidCollectionElement($item, $type);
			$this->add($key, $item);
		}
	}

	protected function assert(mixed $value, ?string $type = null): bool
	{
		if (null === $type) {
			return true;
		}

		return is_typeof($value, $type);
	}

	protected function add(string|int $key, $item): static
	{
		$this->data[$key] = $item;

		return $this;
	}

	public function each(callable $callback): static
	{
		foreach ($this->data as $key => $item) {
			$callback($item, $key);
		}

		return $this;
	}

	public function unique(int $flags = SORT_STRING): static
	{
		$data = array_unique($this->data, $flags);

		return static::collect($data);
	}

	public function map(callable $callback): ListInterface
	{
		$data = array_map($callback, $this->data);

		return MixedList::collect($data);
	}

	public function mapKeys(callable $callback): static
	{
		$data = [];
		foreach ($this as $item) {
			$key = $callback($item);
			$data[$key] = $item;
		}

		return static::collect($data);
	}

	public function filter(?callable $callback = null, int $mode = ARRAY_FILTER_USE_BOTH): static
	{
		$data = array_filter($this->data, $callback, $mode);

		return new static($data);
	}

	public function reduce(callable $callback, mixed $carry = null): mixed
	{
		return array_reduce($this->data, $callback, $carry);
	}

	public function count(): int
	{
		return count($this->data);
	}

	public function toArray(): array
	{
		return $this->data;
	}

	public function values(): array
	{
		return array_values($this->data);
	}

	public function keys(): array
	{
		return array_keys($this->data);
	}

	public function isEmpty(): bool
	{
		return 0 === count($this->data);
	}

	public function getIterator(): Traversable
	{
		foreach ($this->data as $key => $item) {
			yield $key => $item;
		}
	}

	protected function get(string|int $key): mixed
	{
		if (!$this->has($key)) {
			throw new NonExistentElement($key);
		}

		return $this->data[$key];
	}

	protected function has(string|int $key): bool
	{
		return isset($this->data[$key]);
	}
}
