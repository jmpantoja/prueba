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

namespace App\Domain\Vocabulary\Traits;

use App\Domain\Vocabulary\Entry;
use App\Domain\Vocabulary\Event\MeaningHasBeenCreated;
use App\Domain\Vocabulary\Event\MeaningHasBeenUpdated;
use App\Domain\Vocabulary\MeaningId;
use App\Domain\Vocabulary\VO\Deep;
use App\Domain\Vocabulary\VO\Term;
use Tangram\Domain\Event\DomainEventInterface;

trait MeaningBase
{
	private Entry $entry;

	private Term $term;

	private Deep $deep;

	private MeaningId $id;

	public function __construct(Entry $entry, Term $term, Deep $deep)
	{
		$this->id = new MeaningId();
		$this->entry = $entry;

		$this->initialize($term, $deep);
		$this->notify(new MeaningHasBeenCreated($this));
	}

	abstract public function notify(DomainEventInterface $domainEvent): void;

	public function update(Term $term, Deep $deep): static
	{
		$this->initialize($term, $deep);
		$this->notify(new MeaningHasBeenUpdated($this));

		return $this;
	}

	private function initialize(Term $term, Deep $deep): static
	{
		$this->term = $term;
		$this->deep = $deep;

		return $this;
	}

	public function id(): MeaningId
	{
		return $this->id;
	}

	public function entry(): Entry
	{
		return $this->entry;
	}

	public function term(): Term
	{
		return $this->term;
	}

	public function deep(): Deep
	{
		return $this->deep;
	}
}
