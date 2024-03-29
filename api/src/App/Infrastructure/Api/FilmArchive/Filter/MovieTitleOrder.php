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

namespace App\Infrastructure\Api\FilmArchive\Filter;

use Tangram\Infrastructure\Api\Filter\AbstractOrderFilter;

final class MovieTitleOrder extends AbstractOrderFilter
{

    protected function formatOrderClause(string $alias, string $field): string
    {
        return sprintf('%s.%s.title', $alias, $field);
    }
}
