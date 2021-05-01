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

interface GenreRepository
{
    public function save(Genre $genre);

    public function delete(GenreId $genreId);

    public function findById(GenreId $genreId): ?Genre;
}
