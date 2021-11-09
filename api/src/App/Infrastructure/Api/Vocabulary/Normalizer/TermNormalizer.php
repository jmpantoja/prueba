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
use App\Domain\Vocabulary\VO\Term;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class TermNormalizer implements NormalizerInterface, DenormalizerInterface
{
	/**
	 * @param Term $term
	 *
	 * @return mixed
	 */
	public function normalize($term, string $format = null, array $context = [])
	{
		return [
			'term' => $term->term(),
			'lang' => $term->lang(),
		];
	}

	public function supportsNormalization($data, string $format = null)
	{
		return $data instanceof Term;
	}

	public function denormalize($data, string $type, string $format = null, array $context = [])
	{
		return new Term(...[
			'term' => $data['term'],
			'lang' => Lang::from($data['lang']),
		]);
	}

	public function supportsDenormalization($data, string $type, string $format = null)
	{
		return Term::class === $type;
	}
}
