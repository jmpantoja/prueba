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

namespace App\Infrastructure\Api\Music\Normalizer;

use App\Domain\Music\VO\Position;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class PositionNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param Position $position
	 *
	 * @return mixed
	 */
	public function normalize($position, string $format = null, array $context = [])
	{
		return $position->toInt();
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof Position;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return new Position((int) $data);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return Position::class === $type;
	}
}
