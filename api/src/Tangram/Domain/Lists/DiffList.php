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

    public static function compare(EntityList $original, EntityList $other): self
    {
        return new self($original, $other);
    }

    private function __construct(EntityList $original, EntityList $other)
    {
        $this->original = $original->toArray();
        $this->other = $other->toArray();
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
        foreach ($updates as $item) {
            $callback($item);
        }
        return $this;
    }

    public function deletes(callable $callback): self
    {
        $deletes = array_diff_key($this->original, $this->other);
        foreach ($deletes as $item) {
            $callback($item);
        }
        return $this;
    }

}
