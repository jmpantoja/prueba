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

use App\Domain\FilmArchive\Director;
use App\Domain\FilmArchive\DirectorId;
use App\Domain\FilmArchive\DirectorRepository;
use App\Infrastructure\Api\FilmArchive\Dto\DirectorInput;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DirectorDoctrineRepository extends ServiceEntityRepository implements DirectorRepository{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Director::class);
    }

    public function save(Director $Director)
    {
        $this->getEntityManager()->persist($Director);
    }

    public function delete(DirectorId $directorId)
    {
        $director = $this->getEntityManager()->getReference(Director::class, $directorId);
        $this->getEntityManager()->remove($director);
    }

    public function findOrCreate(DirectorInput $input)
    {
        if (null !== $input->id) {
            return $this->find($input->id);
        }

        return new Director($input);
    }
}
