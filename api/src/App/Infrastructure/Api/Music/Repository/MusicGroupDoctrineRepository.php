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

namespace App\Infrastructure\Api\Music\Repository;

use App\Domain\Music\MusicGroup;
use App\Domain\Music\MusicGroupId;
use App\Domain\Music\Repository\MusicGroupRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class MusicGroupDoctrineRepository extends ServiceEntityRepository implements MusicGroupRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, MusicGroup::class);
	}

	public function save(MusicGroup $musicGroup)
	{
		$this->getEntityManager()->persist($musicGroup);
	}

	public function delete(MusicGroupId $musicGroupId)
	{
		$musicGroup = $this->getEntityManager()->getReference(MusicGroup::class, $musicGroupId);
		$this->getEntityManager()->remove($musicGroup);
	}

	public function findById(MusicGroupId $musicGroupId): ?MusicGroup
	{
		return $this->find($musicGroupId);
	}
}
