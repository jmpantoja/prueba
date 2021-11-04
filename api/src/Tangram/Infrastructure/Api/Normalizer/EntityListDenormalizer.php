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

namespace Tangram\Infrastructure\Api\Normalizer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Tangram\Domain\Lists\MixedList;

final class EntityListDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
	private DenormalizerInterface $denormalizer;
	private EntityManagerInterface $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function setDenormalizer(DenormalizerInterface $denormalizer)
	{
		$this->denormalizer = $denormalizer;
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return false;

		return is_array($data) and preg_match('/(.*)\[\]$/', $type);
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		$matches = [];
		preg_match('/(.*)\[\]$/', $type, $matches);

		$className = $matches[1];

		return MixedList::collect($data)
			->map(function (array $item) use ($className) {
				return $this->findOrCreate($item, $className);
			})
			->values();

		return $type::collect($items);
	}

	private function findOrCreate(array $item, string $className)
	{
		$id = $item['id'] ?? null;

		$classNameId = sprintf('%sId', $className);

		if (!is_null($id) and class_exists($classNameId)) {
			$entityId = new $classNameId($id);

			return $this->entityManager->getReference($className, $entityId);
		}

		unset($item['id']);

		return $this->denormalizer->denormalize($item, $className);
	}
}
