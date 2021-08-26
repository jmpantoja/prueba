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

namespace Tangram\Infrastructure\Api\Filter;


class FullNameFilter extends AbstractTextFilter
{
    protected function formatWhereClause(string $alias, string $property, string $paramName): string
    {
        return sprintf('%1$s.%2$s.name like :%3$s OR %1$s.%2$s.lastName like :%3$s', $alias, $property, $paramName);
    }
}
