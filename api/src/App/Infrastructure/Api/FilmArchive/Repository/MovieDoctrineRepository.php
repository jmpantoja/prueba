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

namespace App\Infrastructure\Api\FilmArchive\Repository;

use App\Domain\FilmArchive\Movie;
use App\Domain\FilmArchive\MovieId;
use App\Domain\FilmArchive\MovieRepository;
use App\Infrastructure\Api\FilmArchive\Dto\MovieInput;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class MovieDoctrineRepository extends ServiceEntityRepository implements MovieRepository{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    public function save(Movie $Movie)
    {
        $this->getEntityManager()->persist($Movie);
    }

    public function delete(MovieId $movieId)
    {
        $movie = $this->getEntityManager()->getReference(Movie::class, $movieId);
        $this->getEntityManager()->remove($movie);
    }

    public function findOrCreate(MovieInput $input)
    {
        if (null !== $input->id) {
            return $this->find($input->id);
        }

        return new Movie($input);
    }
}
