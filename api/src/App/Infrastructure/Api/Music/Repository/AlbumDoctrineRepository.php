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

use App\Domain\Music\Album;
use App\Domain\Music\AlbumId;
use App\Domain\Music\Repository\AlbumRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class AlbumDoctrineRepository extends ServiceEntityRepository implements AlbumRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Album::class);
	}

	public function save(Album $album)
	{
		$this->getEntityManager()->persist($album);
	}

	public function delete(AlbumId $albumId)
	{
		$album = $this->getEntityManager()->getReference(Album::class, $albumId);
		$this->getEntityManager()->remove($album);
	}

	public function findById(AlbumId $albumId): ?Album
	{
		return $this->find($albumId);
	}
}
