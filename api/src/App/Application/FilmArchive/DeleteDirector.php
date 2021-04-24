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

use App\Domain\FilmArchive\DirectorId;

final class DeleteDirector {
    /**
    * @var DirectorId
    */
    private DirectorId $directorId;

    /**
    * DeleteDirector constructor.
    * @param DirectorId $directorId
    */
    public function __construct(DirectorId $directorId)
    {
        $this->directorId = $directorId;
    }

    /**
    * @return DirectorId
    */
    public function directorId(): DirectorId    {
        return $this->directorId;
    }
}
