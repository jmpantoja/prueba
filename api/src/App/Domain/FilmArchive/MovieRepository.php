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

interface MovieRepository
{
    public function save(Movie $movie);

    public function delete(MovieId $movieId);

    public function findById(MovieId $movieId): ?Movie;
}


