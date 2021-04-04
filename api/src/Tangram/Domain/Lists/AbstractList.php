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


use IteratorAggregate;
use Tangram\Domain\Lists\Exception\InvalidCollectionElement;
use Traversable;

abstract class AbstractList implements IteratorAggregate
{
    private array $data = [];

    protected function __construct(?iterable $input = null, string $type = null)
    {
        $input = $input ?? [];
        if ($input instanceof Traversable) {
            $input = iterator_to_array($input);
        }

        if (null === $type) {
            $this->data = $input;
            return;
        }
        foreach (array_values($input) as $index => $item) {
            is_typeof($item, $type) || throw new InvalidCollectionElement($item, $type);
            $this->add($index, $item);
        }
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

    public function map(callable $callback): self
    {
        $data = array_map($callback, $this->data);
        return MixedList::collect($data);
    }

    public function filter(?callable $callback = null, int $mode = 0): static
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


    public function getIterator(): Traversable
    {
        foreach ($this->data as $item) {
            yield $item;
        }
    }
}
