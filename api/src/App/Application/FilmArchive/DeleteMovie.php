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

use App\Domain\FilmArchive\MovieId;

final class DeleteMovie {
    /**
    * @var MovieId
    */
    private MovieId $movieId;

    /**
    * DeleteMovie constructor.
    * @param MovieId $movieId
    */
    public function __construct(MovieId $movieId)
    {
        $this->movieId = $movieId;
    }

    /**
    * @return MovieId
    */
    public function movieId(): MovieId    {
        return $this->movieId;
    }
}
