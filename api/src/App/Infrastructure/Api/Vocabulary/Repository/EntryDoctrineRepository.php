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

use App\Domain\Vocabulary\Entry;
use App\Domain\Vocabulary\EntryId;
use App\Domain\Vocabulary\Repository\EntryRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class EntryDoctrineRepository extends ServiceEntityRepository implements EntryRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Entry::class);
	}

	public function save(Entry $entry)
	{
		$this->getEntityManager()->persist($entry);
	}

	public function delete(EntryId $entryId)
	{
		$entry = $this->getEntityManager()->getReference(Entry::class, $entryId);
		$this->getEntityManager()->remove($entry);
	}

	public function findById(EntryId $entryId): ?Entry
	{
		return $this->find($entryId);
	}
}
