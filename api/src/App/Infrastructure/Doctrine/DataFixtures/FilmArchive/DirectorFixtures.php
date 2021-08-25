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

use App\Application\FilmArchive\SaveDirector;
use App\Domain\FilmArchive\Director;
use App\Domain\FilmArchive\MovieList;
use Tangram\Domain\ValueObject\FullName;
use Tangram\Infrastructure\Doctrine\DataFixtures\UseCaseFixture;

final class DirectorFixtures extends UseCaseFixture
{
    public function loadData(): void
    {
        $data = [
            [
                'name' => new FullName('Martin', 'Scorsese'),
                'movies' => MovieList::collect()
            ],
            [
                'name' => new FullName('Steven', 'Spielberg'),
                'movies' => MovieList::collect()
            ],
            [
                'name' => new FullName('Christopher', 'Nolan'),
                'movies' => MovieList::collect()
            ],
            [
                'name' => new FullName('David', 'Fincher'),
                'movies' => MovieList::collect()
            ],
            [
                'name' => new FullName('Denis', 'Villeneuve'),
                'movies' => MovieList::collect()
            ],
        ];

        $items = $this->createRange($data, function ($values) {
            return new Director(...$values);
        });

        foreach ($items as $director) {
            $this->handle(new SaveDirector($director));
        }
    }
}
