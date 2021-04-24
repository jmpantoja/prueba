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
use App\Domain\FilmArchive\MovieTitle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class BorrameController extends AbstractController
{
    private ValidatorInterface $validator;


    public function __invoke()
    {
        $movieTitle = new MovieTitle('s');

        return new JsonResponse([
            'title' => (string)$movieTitle
        ]);
    }


}
