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

namespace App\Application\FilmArchive;

use App\Domain\FilmArchive\Movie;

final class SaveMovie {
    /**
    * @var Movie    */
    private Movie $movie;

    /**
    * SaveMovie constructor.
    * @param Movie $movie
    */
    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    /**
    * @return Movie
    */
    public function movie(): Movie    {
        return $this->movie;
    }
}
