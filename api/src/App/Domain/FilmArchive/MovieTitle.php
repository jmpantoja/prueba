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

final class MovieTitle
{
    use Assert;

    private string $title;

    public function __construct(string $title)
    {
        $this->assert($title);
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    public function __toString()
    {
        return $this->title();
    }
}
