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

use App\Domain\FilmArchive\Director;

final class SaveDirector {
    /**
    * @var Director    */
    private Director $director;

    /**
    * SaveDirector constructor.
    * @param Director $director
    */
    public function __construct(Director $director)
    {
        $this->director = $director;
    }

    /**
    * @return Director
    */
    public function director(): Director    {
        return $this->director;
    }
}
