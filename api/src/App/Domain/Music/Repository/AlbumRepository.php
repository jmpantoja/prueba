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

namespace App\Domain\Music\Repository;

use App\Domain\Music\Album;
use App\Domain\Music\AlbumId;

interface AlbumRepository
{
	public function save(Album $album);

	public function delete(AlbumId $albumId);

	public function findById(AlbumId $albumId): ?Album;
}
