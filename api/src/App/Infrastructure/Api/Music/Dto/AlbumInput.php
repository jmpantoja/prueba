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

namespace App\Infrastructure\Api\Music\Dto;

use App\Domain\Music\MusicGroup;
use App\Domain\Music\VO\AlbumName;
use App\Domain\Music\VO\Money;
use App\Domain\Music\VO\Year;
use Tangram\Infrastructure\Api\Dto\Input;

final class AlbumInput extends Input
{
	public MusicGroup $group;

	public AlbumName $name;

	public Money $price;

	public Year $releaseAt;
}
