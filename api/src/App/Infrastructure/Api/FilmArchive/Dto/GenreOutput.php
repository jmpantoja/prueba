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

namespace App\Infrastructure\Api\FilmArchive\Dto;

use App\Domain\FilmArchive\GenreId;
use App\Domain\FilmArchive\GenreList;
use App\Domain\FilmArchive\MovieList;
use Doctrine\Common\Collections\Collection;
use App\Domain\FilmArchive\Genre;

final class GenreOutput  {

	public ?GenreId $id = null;
	public string $name;
//	public MovieList $movies;

    public static function make(Genre $entity): self
    {
        return new self($entity);
    }

    private function __construct(Genre $entity){
		$this->id = $entity->id();
		$this->name = $entity->name();
	//	$this->movies = $entity->movies();
    }
}

