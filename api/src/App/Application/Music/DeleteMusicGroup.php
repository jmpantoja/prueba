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

use App\Domain\Music\MusicGroupId;

final class DeleteMusicGroup
{
	private MusicGroupId $musicGroupId;

	public function __construct(MusicGroupId $musicGroupId)
	{
		$this->musicGroupId = $musicGroupId;
	}

	public function musicGroupId(): MusicGroupId
	{
		return $this->musicGroupId;
	}
}
