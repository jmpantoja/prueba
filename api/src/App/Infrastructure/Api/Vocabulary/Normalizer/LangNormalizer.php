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

use App\Domain\Vocabulary\VO\Lang;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class LangNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param Lang $lang
	 *
	 * @return mixed
	 */
	public function normalize($lang, string $format = null, array $context = [])
	{
		return $lang->getValue();
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof Lang;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return Lang::from($data);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return Lang::class === $type;
	}
}
