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

use App\Domain\FilmArchive\Genre;

final class SaveGenre {
    /**
    * @var Genre    */
    private Genre $genre;

    /**
    * SaveGenre constructor.
    * @param Genre $genre
    */
    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    /**
    * @return Genre
    */
    public function genre(): Genre    {
        return $this->genre;
    }
}
