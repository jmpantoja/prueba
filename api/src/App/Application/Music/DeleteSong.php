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

namespace App\Application\Music;

use App\Domain\Music\SongId;

final class DeleteSong
{
	private SongId $songId;

	public function __construct(SongId $songId)
	{
		$this->songId = $songId;
	}

	public function songId(): SongId
	{
		return $this->songId;
	}
}
