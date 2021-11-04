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

use App\Domain\Vocabulary\VO\Level;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class LevelNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param Level $level
	 *
	 * @return mixed
	 */
	public function normalize($level, string $format = null, array $context = [])
	{
		return [
			'level' => $level->level(),
			'page' => $level->page(),
		];
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof Level;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return new Level(...$data);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return Level::class === $type;
	}
}
