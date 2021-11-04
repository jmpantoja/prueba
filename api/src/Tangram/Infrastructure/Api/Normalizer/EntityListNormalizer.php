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

use App\Domain\FilmArchive\GenreList;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Tangram\Domain\Lists\EntityList;

final class EntityListNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
	private NormalizerInterface $normalizer;

	public function setNormalizer(NormalizerInterface $normalizer)
	{
		$this->normalizer = $normalizer;
	}

	/**
	 * @param GenreList $object
	 *
	 * @return mixed
	 *
	 * @throws ExceptionInterface
	 */
	public function normalize($object, string $format = null, array $context = [])
	{
		return $object->map(function ($item) use ($format, $context) {
			return $this->normalizer->normalize($item, $format, $context);
		})->values();
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof EntityList;
	}
}
