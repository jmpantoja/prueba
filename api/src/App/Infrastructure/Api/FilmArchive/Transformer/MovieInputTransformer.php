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
use App\Infrastructure\Api\FilmArchive\Dto\MovieInput;
use App\Domain\FilmArchive\Movie;
use App\Domain\FilmArchive\MovieRepository;

final class MovieInputTransformer implements DataTransformerInterface {

    private ValidatorInterface $validator;
    private MovieRepository $repository;

    public function __construct(ValidatorInterface $validator, MovieRepository $repository)
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    /**
    * @param MovieInput $input
    * @param string $to
    * @param array $context
    * @return object|void
    */
    public function transform($input, string $to, array $context = [])
    {
        $this->validator->validate($input, $context);

        $movie = $this->findEntity($input, $context);
        $data = (array)$input;
        unset($data['id']);

        if (null === $movie) {
            return new Movie(...$data);
        }

        $movie->update(...$data);
        return $movie;
    }

    private function findEntity(MovieInput $input, array $context): ?Movie    {
        $movie = $context[ObjectNormalizer::OBJECT_TO_POPULATE] ?? null;
        if($movie instanceof Movie){
            return $movie;
        }

        if(is_null($input->id)){
            return null;
        }

        return $this->repository->find($input->id);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === Movie::class;
    }
}

