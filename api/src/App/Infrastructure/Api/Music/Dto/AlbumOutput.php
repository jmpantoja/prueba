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

use App\Domain\Music\Album;
use App\Domain\Music\AlbumId;
use App\Domain\Music\MusicGroup;
use App\Domain\Music\VO\AlbumName;
use App\Domain\Music\VO\Money;
use App\Domain\Music\VO\Year;

final class AlbumOutput
{
	public AlbumId $id;

	public MusicGroup $group;

	public AlbumName $name;

	public Money $price;

	public Year $releaseAt;

	public static function make(Album $album): self
	{
		return new self($album);
	}

	private function __construct(Album $album)
	{
		$this->id = $album->id();
		$this->group = $album->group();
		$this->name = $album->name();
		$this->price = $album->price();
		$this->releaseAt = $album->releaseAt();
	}
}
