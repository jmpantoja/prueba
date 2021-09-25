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

use App\Domain\Music\Event\SongHasBeenCreated;
use App\Domain\Music\Event\SongHasBeenUpdated;
use App\Domain\Music\SongId;
use App\Domain\Music\VO\Duration;
use App\Domain\Music\VO\Position;
use App\Domain\Music\VO\SongName;
use Tangram\Domain\Event\DomainEventInterface;

trait SongBase
{
	private Position $order;

	private SongName $name;

	private Duration $duration;

	private SongId $id;

	public function __construct(Position $order, SongName $name, Duration $duration)
	{
		$this->id = new SongId();

		$this->initialize($order, $name, $duration);
		$this->notify(new SongHasBeenCreated($this));
	}

	abstract public function notify(DomainEventInterface $domainEvent): void;

	public function update(Position $order, SongName $name, Duration $duration): static
	{
		$this->initialize($order, $name, $duration);
		$this->notify(new SongHasBeenUpdated($this));

		return $this;
	}

	private function initialize(Position $order, SongName $name, Duration $duration): static
	{
		$this->order = $order;
		$this->name = $name;
		$this->duration = $duration;

		return $this;
	}

	public function id(): SongId
	{
		return $this->id;
	}

	public function order(): Position
	{
		return $this->order;
	}

	public function name(): SongName
	{
		return $this->name;
	}

	public function duration(): Duration
	{
		return $this->duration;
	}
}
