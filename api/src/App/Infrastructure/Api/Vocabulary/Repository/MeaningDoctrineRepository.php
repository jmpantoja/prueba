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

namespace App\Infrastructure\Api\Vocabulary\Repository;

use App\Domain\Vocabulary\Meaning;
use App\Domain\Vocabulary\MeaningId;
use App\Domain\Vocabulary\Repository\MeaningRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class MeaningDoctrineRepository extends ServiceEntityRepository implements MeaningRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Meaning::class);
	}

	public function save(Meaning $meaning)
	{
		$this->getEntityManager()->persist($meaning);
	}

	public function delete(MeaningId $meaningId)
	{
		$meaning = $this->getEntityManager()->getReference(Meaning::class, $meaningId);
		$this->getEntityManager()->remove($meaning);
	}

	public function findById(MeaningId $meaningId): ?Meaning
	{
		return $this->find($meaningId);
	}
}
