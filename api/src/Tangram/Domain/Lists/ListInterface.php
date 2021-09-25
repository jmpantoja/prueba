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
use Traversable;

interface ListInterface extends IteratorAggregate
{
	public function each(callable $callback): static;

	public function map(callable $callback): ListInterface;

	public function filter(?callable $callback = null, int $mode = 0): static;

	public function reduce(callable $callback, mixed $carry = null): mixed;

	public function count(): int;

	public function toArray(): array;

	public function values(): array;

	public function keys(): array;

	public function isEmpty(): bool;

	public function getIterator(): Traversable;
}
