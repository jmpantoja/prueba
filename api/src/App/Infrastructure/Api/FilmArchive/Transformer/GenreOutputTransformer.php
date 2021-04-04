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
use App\Infrastructure\Api\FilmArchive\Dto\GenreOutput;
use App\Domain\FilmArchive\Genre;

final class GenreOutputTransformer implements DataTransformerInterface {

    /**
    * @param Genre $object
    * @param string $to
    * @param array $context
    * @return object|void
    */
    public function transform($object, string $to, array $context = [])
    {
        return GenreOutput::make($object);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === GenreOutput::class;
    }
}
