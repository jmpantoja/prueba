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


abstract class TypedList extends AbstractList
{
    public static function collect(?iterable $input = null): static
    {
        return new static($input);
    }

    protected function __construct(?iterable $input = null)
    {
        parent::__construct($input, $this->type());
    }

    abstract public function type(): string;

}
