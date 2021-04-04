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

use App\Domain\FilmArchive\Genre;
use App\Domain\FilmArchive\GenreId;
use App\Domain\FilmArchive\GenreRepository;
use App\Infrastructure\Api\FilmArchive\Dto\GenreInput;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class GenreDoctrineRepository extends ServiceEntityRepository implements GenreRepository{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genre::class);
    }

    public function save(Genre $Genre)
    {
        $this->getEntityManager()->persist($Genre);
    }

    public function delete(GenreId $genreId)
    {
        $genre = $this->getEntityManager()->getReference(Genre::class, $genreId);
        $this->getEntityManager()->remove($genre);
    }

    public function findOrCreate(GenreInput $input)
    {
        if (null !== $input->id) {
            return $this->find($input->id);
        }

        return new Genre($input);
    }
}
