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

use App\Domain\Music\VO\Currency;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class CurrencyNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param Currency $currency
	 *
	 * @return mixed
	 */
	public function normalize($currency, string $format = null, array $context = [])
	{
		return $currency->getValue();
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof Currency;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return Currency::from($data);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return Currency::class === $type;
	}
}
