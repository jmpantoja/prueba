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
use App\Infrastructure\Api\FilmArchive\Dto\DirectorOutput;
use App\Domain\FilmArchive\Director;

final class DirectorOutputTransformer implements DataTransformerInterface {

    /**
    * @param Director $object
    * @param string $to
    * @param array $context
    * @return object|void
    */
    public function transform($object, string $to, array $context = [])
    {
        return DirectorOutput::make($object);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === DirectorOutput::class;
    }
}
