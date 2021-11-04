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

use App\Domain\Vocabulary\VO\EntryType;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class EntryTypeNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param EntryType $entryType
	 *
	 * @return mixed
	 */
	public function normalize($entryType, string $format = null, array $context = [])
	{
		return $entryType->getValue();
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof EntryType;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return EntryType::from($data);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return EntryType::class === $type;
	}
}
