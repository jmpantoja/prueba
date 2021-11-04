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

namespace App\Infrastructure\Api\Vocabulary\Normalizer;

use App\Domain\Vocabulary\VO\Deep;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class DeepNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param Deep $deep
	 *
	 * @return mixed
	 */
	public function normalize($deep, string $format = null, array $context = [])
	{
		return $deep->toInt();
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof Deep;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return new Deep((int) $data);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return Deep::class === $type;
	}
}
