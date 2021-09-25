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

use App\Domain\Music\Repository\SongRepository;
use App\Domain\Music\Song;
use App\Domain\Music\SongId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class SongDoctrineRepository extends ServiceEntityRepository implements SongRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Song::class);
	}

	public function save(Song $song)
	{
		$this->getEntityManager()->persist($song);
	}

	public function delete(SongId $songId)
	{
		$song = $this->getEntityManager()->getReference(Song::class, $songId);
		$this->getEntityManager()->remove($song);
	}

	public function findById(SongId $songId): ?Song
	{
		return $this->find($songId);
	}
}
