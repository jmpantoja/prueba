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

namespace App\Domain\FilmArchive;


use Tangram\Domain\Assertion\Traits\Assert;

final class MovieYear
{
    use Assert;

    private int $year;

    public function __construct(int $year)
    {
        $this->assert($year);
        $this->year = $year;
    }

    /**
     * @return int
     */
    public function year(): int
    {
        return $this->year;
    }
}
