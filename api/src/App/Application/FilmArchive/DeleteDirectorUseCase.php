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

use App\Domain\FilmArchive\DirectorRepository;
use Tangram\Application\UseCase\UseCaseInterface;


final class DeleteDirectorUseCase implements UseCaseInterface{
    /**
    * @var DirectorRepository    */
    private DirectorRepository $repository;

    public function __construct(DirectorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(DeleteDirector $command)
    {
        $this->repository->delete($command->directorId());
    }
}
