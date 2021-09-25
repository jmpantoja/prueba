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

use App\Domain\Music\VO\AlbumName;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class AlbumNameNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param AlbumName $albumName
	 *
	 * @return mixed
	 */
	public function normalize($albumName, string $format = null, array $context = [])
	{
		return (string) $albumName;
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof AlbumName;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return new AlbumName($data);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return AlbumName::class === $type;
	}
}
