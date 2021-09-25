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

use App\Domain\Music\VO\GroupName;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class GroupNameNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param GroupName $groupName
	 *
	 * @return mixed
	 */
	public function normalize($groupName, string $format = null, array $context = [])
	{
		return (string) $groupName;
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof GroupName;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return new GroupName($data);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return GroupName::class === $type;
	}
}
