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

use App\Domain\Music\Song;

final class SaveSong
{
	private Song $song;

	public function __construct(Song $song)
	{
		$this->song = $song;
	}

	public function song(): Song
	{
		return $this->song;
	}
}
