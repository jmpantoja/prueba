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

namespace App\Infrastructure\Doctrine\DataFixtures\FilmArchive;

use App\Application\FilmArchive\SaveGenre;
use App\Domain\FilmArchive\Genre;
use Tangram\Infrastructure\Doctrine\DataFixtures\UseCaseFixture;

final class GenreFixtures extends UseCaseFixture
{

    public function loadData(): void
    {
//        $genres = ['comedia', 'drama', 'terror', 'musical', 'aventuras'];
//
//        $items = $this->createRange($genres, function (string $name) {
//            return new Genre($name);
//        });

        $indexes = range(1, 165);
        $items = $this->createRange($indexes, function (int $index) {
            return new Genre(sprintf('genero %02d', $index));
        });

        foreach ($items as $genre) {
            $this->handle(new SaveGenre($genre));
        }


    }
}
