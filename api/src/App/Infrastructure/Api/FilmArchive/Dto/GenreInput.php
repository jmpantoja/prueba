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
use Doctrine\Common\Collections\Collection;
use App\Domain\FilmArchive\Genre;

final class GenreInput  {

	public ?GenreId $id = null;
	public string $name;
}
