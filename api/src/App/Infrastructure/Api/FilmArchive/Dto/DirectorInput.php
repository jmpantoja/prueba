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

use App\Domain\FilmArchive\DirectorId;
use Tangram\Domain\ValueObject\FullName;

final class DirectorInput  {

	public ?DirectorId $id = null;
	public FullName $name;
}
