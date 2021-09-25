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

use App\Domain\Music\VO\Duration;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class DurationNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param Duration $duration
	 *
	 * @return mixed
	 */
	public function normalize($duration, string $format = null, array $context = [])
	{
		return [
			'minutes' => $duration->minutes(),
			'seconds' => $duration->seconds(),
		];
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof Duration;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return new Duration(...$data);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return Duration::class === $type;
	}
}
