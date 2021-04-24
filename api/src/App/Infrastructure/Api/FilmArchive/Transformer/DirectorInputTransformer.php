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
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use App\Infrastructure\Api\FilmArchive\Dto\DirectorInput;
use App\Domain\FilmArchive\Director;

final class DirectorInputTransformer implements DataTransformerInterface {

    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
    * @param DirectorInput $directorInput
    * @param string $to
    * @param array $context
    * @return object|void
    */
    public function transform($input, string $to, array $context = [])
    {
        $this->validator->validate($input, $context);

        /** @var Director $director */
        $director = $context[ObjectNormalizer::OBJECT_TO_POPULATE] ?? null;
        $data = (array)$input;

        if (null === $director) {
            return new Director(...$data);
        }

        $director->update(...$data);
        return $director;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === Director::class;
    }
}

