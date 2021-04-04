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

use App\Application\FilmArchive\SaveMovie;
use App\Domain\FilmArchive\Movie;
use App\Domain\FilmArchive\MovieTitle;
use App\Domain\FilmArchive\MovieYear;
use Tangram\Infrastructure\Doctrine\DataFixtures\UseCaseFixture;

final class MovieFixtures extends UseCaseFixture
{

    public function loadData(): void
    {
        $items = $this->createMany(9, function ($cont) {
            return new Movie(...[
                'title' => new MovieTitle(sprintf('episodio %s', $cont)),
                'year' => new MovieYear((int)$this->faker->year)
            ]);
        });

        foreach ($items as $movie) {
            $this->handle(new SaveMovie($movie));
        }
    }
}
