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

use App\Domain\Music\VO\Country;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class CountryNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param Country $country
	 *
	 * @return mixed
	 */
	public function normalize($country, string $format = null, array $context = [])
	{
		return $country->getValue();
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof Country;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return Country::from($data);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return Country::class === $type;
	}
}
