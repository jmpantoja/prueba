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

use App\Domain\Vocabulary\VO\AudioPath;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class AudioPathNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param AudioPath $audioPath
	 *
	 * @return mixed
	 */
	public function normalize($audioPath, string $format = null, array $context = [])
	{
		return (string) $audioPath;
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof AudioPath;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return new AudioPath($data);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return AudioPath::class === $type;
	}
}
