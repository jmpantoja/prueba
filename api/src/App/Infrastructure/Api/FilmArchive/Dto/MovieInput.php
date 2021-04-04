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

namespace App\Infrastructure\Api\FilmArchive\Dto;

use App\Domain\FilmArchive\GenreList;
use App\Domain\FilmArchive\MovieTitle;
use App\Domain\FilmArchive\MovieYear;

final class MovieInput
{
    public MovieTitle $title;
    public MovieYear $year;
    public GenreList $genres;
}
