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

use App\Domain\Music\Album;

final class SaveAlbum
{
	private Album $album;

	public function __construct(Album $album)
	{
		$this->album = $album;
	}

	public function album(): Album
	{
		return $this->album;
	}
}
