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

namespace App\Infrastructure\UI\Symfony\Controller;


use App\Domain\FilmArchive\Builder\GenreInput;
use App\Domain\FilmArchive\GenreList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Tangram\Infrastructure\Api\Normalizer\EntityListDenormalizer;

final class BorrameController extends AbstractController
{
    private ValidatorInterface $validator;
    private EntityListDenormalizer $listDenormalizer;


    public function __construct(EntityListDenormalizer $listDenormalizer)
    {
        $this->listDenormalizer = $listDenormalizer;
    }

    public function __invoke()
    {
        $list = $this->listDenormalizer->denormalize([
            ['id'=>'01792d18-321c-34f2-0018-a02f227b6a73']
        ], GenreList::class);


        return new JsonResponse([
            'list' => $list->toArray()
        ]);
    }


}
