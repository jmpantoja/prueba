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

namespace App\Infrastructure\Api\FilmArchive\Transformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use App\Infrastructure\Api\FilmArchive\Dto\MovieInput;
use App\Domain\FilmArchive\Movie;

final class MovieInputTransformer implements DataTransformerInterface {


    /**
    * @param MovieInput $movieInput
    * @param string $to
    * @param array $context
    * @return object|void
    */
    public function transform($input, string $to, array $context = [])
    {
        /** @var Movie $movie */
        $movie = $context[ObjectNormalizer::OBJECT_TO_POPULATE] ?? null;
        $data = (array)$input;

        if (null === $movie) {
            return new Movie(...$data);
        }

        $movie->update(...$data);
        return $movie;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === Movie::class;
    }
}

