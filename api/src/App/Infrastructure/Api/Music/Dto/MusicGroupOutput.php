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

use App\Domain\Music\AlbumList;
use App\Domain\Music\MusicGroup;
use App\Domain\Music\MusicGroupId;
use App\Domain\Music\VO\Country;
use App\Domain\Music\VO\GroupName;

final class MusicGroupOutput
{
	public MusicGroupId $id;

	public GroupName $name;

	public Country $country;

	public AlbumList $albums;

	public static function make(MusicGroup $musicGroup): self
	{
		return new self($musicGroup);
	}

	private function __construct(MusicGroup $musicGroup)
	{
		$this->id = $musicGroup->id();
		$this->name = $musicGroup->name();
		$this->country = $musicGroup->country();
		$this->albums = $musicGroup->albums();
	}
}
