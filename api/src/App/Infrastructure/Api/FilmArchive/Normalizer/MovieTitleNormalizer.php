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

use App\Domain\FilmArchive\MovieTitle;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class MovieTitleNormalizer implements NormalizerInterface, DenormalizerInterface {
    /**
    * @param MovieTitle $movieTitle    * @param string|null $format
    * @param array $context
    * @return mixed
    */
    public function normalize($movieTitle, string $format = null, array $context = [])
    {
        return $movieTitle->title();
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof MovieTitle;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return new MovieTitle($data);
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return $type === MovieTitle::class;
    }
}
