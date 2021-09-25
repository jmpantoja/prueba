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

use ArrayObject;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Tangram\Domain\Model\EntityId;

final class EntityIdNormalizer implements NormalizerInterface
{
	/**
	 * @param EntityId $object
	 *
	 * @return array|ArrayObject|bool|float|int|string|void|null
	 */
	public function normalize($object, string $format = null, array $context = [])
	{
		//usleep((int)3 * 1000000);
		return (string) $object;
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof EntityId;
	}
}
