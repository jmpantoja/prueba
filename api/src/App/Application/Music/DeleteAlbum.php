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

use App\Domain\Music\AlbumId;

final class DeleteAlbum
{
	private AlbumId $albumId;

	public function __construct(AlbumId $albumId)
	{
		$this->albumId = $albumId;
	}

	public function albumId(): AlbumId
	{
		return $this->albumId;
	}
}
