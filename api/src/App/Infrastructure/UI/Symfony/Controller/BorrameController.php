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
use App\Domain\FilmArchive\Genre;
use App\Domain\FilmArchive\GenreList;
use App\Domain\FilmArchive\GenreRepository;
use App\Domain\FilmArchive\Movie;
use App\Domain\FilmArchive\MovieRepository;
use App\Infrastructure\Api\FilmArchive\Dto\MovieOutput;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Tangram\Domain\Lists\DiffList;


final class BorrameController extends AbstractController
{
    private MovieRepository $repository;
    private GenreRepository $genres;

    public function __construct(MovieRepository $movies, GenreRepository $genres)
    {
        $this->repository = $movies;
        $this->genres = $genres;
    }

    public function __invoke()
    {
        /** @var Movie $movie */
        $movie = $this->repository->find('0178d749-ec06-3510-aa24-2f76363f2cc0');

        $listOfGenres = GenreList::collect([
            $this->genres->find('0178ccf1-9397-085c-4368-8bfef7951833'), //musical
            //      $this->genres->find('0178ccf1-939e-16c8-ffd0-37bb855e87a0'), //aventuras
            $this->genres->find('0178ccf1-939c-4f10-6024-89b6a167ba94'), //comedia
            $this->genres->find('0178ccf1-939a-fcbf-71e5-629e0dabd4c4'), //terror,

            new Genre(GenreInput::make([
                'name' => 'pepito'
            ]))

        ]);


        //musical
        //aventuras
        $diffList = DiffList::compare($movie->genres(), $listOfGenres)
            ->inserts(function (Genre $genre) {
                echo sprintf('Insert: %s<br/>', $genre->name());
            })
            ->updates(function (Genre $genre) {
                echo sprintf('Update: %s<br/>', $genre->name());
            })
            ->deletes(function (Genre $genre) {
                echo sprintf('Delete: %s<br/>', $genre->name());
            });


        die(__METHOD__);
        return new JsonResponse([
            //    'data' => $list->toArray()
        ]);
    }


}
