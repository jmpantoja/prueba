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

use App\Domain\Music\Song;
use App\Domain\Music\SongId;

interface SongRepository
{
	public function save(Song $song);

	public function delete(SongId $songId);

	public function findById(SongId $songId): ?Song;
}
