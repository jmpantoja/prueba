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

use App\Domain\FilmArchive\GenreId;

final class DeleteGenre {
    /**
    * @var GenreId
    */
    private GenreId $genreId;

    /**
    * DeleteGenre constructor.
    * @param GenreId $genreId
    */
    public function __construct(GenreId $genreId)
    {
        $this->genreId = $genreId;
    }

    /**
    * @return GenreId
    */
    public function genreId(): GenreId    {
        return $this->genreId;
    }
}
