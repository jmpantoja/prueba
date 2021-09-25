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

use App\Domain\Music\MusicGroup;
use App\Domain\Music\MusicGroupId;

interface MusicGroupRepository
{
	public function save(MusicGroup $musicGroup);

	public function delete(MusicGroupId $musicGroupId);

	public function findById(MusicGroupId $musicGroupId): ?MusicGroup;
}
