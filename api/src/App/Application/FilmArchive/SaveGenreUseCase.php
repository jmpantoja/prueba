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

use App\Domain\FilmArchive\GenreRepository;
use Tangram\Application\UseCase\UseCaseInterface;


final class SaveGenreUseCase implements UseCaseInterface{
    /**
    * @var GenreRepository    */
    private GenreRepository $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(SaveGenre $command)
    {
        $this->repository->save($command->genre());
    }
}
