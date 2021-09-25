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

namespace App\Domain\Music\Traits;

use App\Domain\Music\AlbumId;
use App\Domain\Music\Event\AlbumHasBeenCreated;
use App\Domain\Music\Event\AlbumHasBeenUpdated;
use App\Domain\Music\MusicGroup;
use App\Domain\Music\VO\AlbumName;
use App\Domain\Music\VO\Money;
use App\Domain\Music\VO\Year;
use Tangram\Domain\Event\DomainEventInterface;

trait AlbumBase
{
	private MusicGroup $group;

	private AlbumName $name;

	private Money $price;

	private Year $releaseAt;

	private AlbumId $id;

	public function __construct(MusicGroup $group, AlbumName $name, Money $price, Year $releaseAt)
	{
		$this->id = new AlbumId();

		$this->initialize($group, $name, $price, $releaseAt);
		$this->notify(new AlbumHasBeenCreated($this));
	}

	abstract public function notify(DomainEventInterface $domainEvent): void;

	public function update(MusicGroup $group, AlbumName $name, Money $price, Year $releaseAt): static
	{
		$this->initialize($group, $name, $price, $releaseAt);
		$this->notify(new AlbumHasBeenUpdated($this));

		return $this;
	}

	private function initialize(MusicGroup $group, AlbumName $name, Money $price, Year $releaseAt): static
	{
		$this->group = $group;
		$this->name = $name;
		$this->price = $price;
		$this->releaseAt = $releaseAt;

		return $this;
	}

	public function id(): AlbumId
	{
		return $this->id;
	}

	public function group(): MusicGroup
	{
		return $this->group;
	}

	public function name(): AlbumName
	{
		return $this->name;
	}

	public function price(): Money
	{
		return $this->price;
	}

	public function releaseAt(): Year
	{
		return $this->releaseAt;
	}
}
