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

namespace App\Infrastructure\Api\FilmArchive\Normalizer;

use App\Domain\FilmArchive\MovieYear;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class MovieYearNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param MovieYear $movieYear * @param string|null $format
     * @param array $context
     * @return mixed
     */
    public function normalize($movieYear, string $format = null, array $context = [])
    {
        return $movieYear->year();
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof MovieYear;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return new MovieYear((int)$data);
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return $type === MovieYear::class;
    }
}
