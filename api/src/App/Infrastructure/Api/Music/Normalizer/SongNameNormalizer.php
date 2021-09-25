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

use App\Domain\Music\VO\SongName;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class SongNameNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param SongName $songName
	 *
	 * @return mixed
	 */
	public function normalize($songName, string $format = null, array $context = [])
	{
		return (string) $songName;
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof SongName;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return new SongName($data);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return SongName::class === $type;
	}
}
