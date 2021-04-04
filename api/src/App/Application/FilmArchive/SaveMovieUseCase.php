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

use App\Domain\FilmArchive\MovieRepository;
use Tangram\Application\UseCase\UseCaseInterface;


final class SaveMovieUseCase implements UseCaseInterface{
    /**
    * @var MovieRepository    */
    private MovieRepository $repository;

    public function __construct(MovieRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(SaveMovie $command)
    {
        $this->repository->save($command->movie());
    }
}
