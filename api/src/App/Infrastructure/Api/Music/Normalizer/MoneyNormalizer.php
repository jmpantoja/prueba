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
use App\Domain\Music\VO\Money;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class MoneyNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param Money $money
	 *
	 * @return mixed
	 */
	public function normalize($money, string $format = null, array $context = [])
	{
		return [
			'amount' => $money->amount(),
			'currency' => $money->currency(),
		];
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof Money;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return new Money(...[
			'amount' => $data['amount'],
			'currency' => Currency::from($data['currency']),
		]);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return Money::class === $type;
	}
}
