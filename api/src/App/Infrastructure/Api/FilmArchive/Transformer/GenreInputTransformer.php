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
use App\Infrastructure\Api\FilmArchive\Dto\GenreInput;
use App\Domain\FilmArchive\Genre;
use App\Domain\FilmArchive\GenreRepository;

final class GenreInputTransformer implements DataTransformerInterface {

    private ValidatorInterface $validator;
    private GenreRepository $repository;

    public function __construct(ValidatorInterface $validator, GenreRepository $repository)
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    /**
    * @param GenreInput $input
    * @param string $to
    * @param array $context
    * @return object|void
    */
    public function transform($input, string $to, array $context = [])
    {
        $this->validator->validate($input, $context);

        $genre = $this->findEntity($input, $context);
        $data = (array)$input;
        unset($data['id']);

        if (null === $genre) {
            return new Genre(...$data);
        }

        $genre->update(...$data);
        return $genre;
    }

    private function findEntity(GenreInput $input, array $context): ?Genre    {
        $genre = $context[ObjectNormalizer::OBJECT_TO_POPULATE] ?? null;
        if($genre instanceof Genre){
            return $genre;
        }

        if(is_null($input->id)){
            return null;
        }

        return $this->repository->find($input->id);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === Genre::class;
    }
}

