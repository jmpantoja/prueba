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

use App\Domain\Music\MusicGroup;

final class SaveMusicGroup
{
	private MusicGroup $musicGroup;

	public function __construct(MusicGroup $musicGroup)
	{
		$this->musicGroup = $musicGroup;
	}

	public function musicGroup(): MusicGroup
	{
		return $this->musicGroup;
	}
}
