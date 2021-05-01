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
use App\Domain\FilmArchive\DirectorRepository;

final class DirectorInputTransformer implements DataTransformerInterface {

    private ValidatorInterface $validator;
    private DirectorRepository $repository;

    public function __construct(ValidatorInterface $validator, DirectorRepository $repository)
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    /**
    * @param DirectorInput $input
    * @param string $to
    * @param array $context
    * @return object|void
    */
    public function transform($input, string $to, array $context = [])
    {
        $this->validator->validate($input, $context);

        $director = $this->findEntity($input, $context);
        $data = (array)$input;
        unset($data['id']);

        if (null === $director) {
            return new Director(...$data);
        }

        $director->update(...$data);
        return $director;
    }

    private function findEntity(DirectorInput $input, array $context): ?Director    {
        $director = $context[ObjectNormalizer::OBJECT_TO_POPULATE] ?? null;
        if($director instanceof Director){
            return $director;
        }

        if(is_null($input->id)){
            return null;
        }

        return $this->repository->find($input->id);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === Director::class;
    }
}

