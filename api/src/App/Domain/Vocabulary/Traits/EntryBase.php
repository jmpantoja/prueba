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

use App\Domain\Vocabulary\EntryId;
use App\Domain\Vocabulary\Event\EntryHasBeenCreated;
use App\Domain\Vocabulary\Event\EntryHasBeenUpdated;
use App\Domain\Vocabulary\Meaning;
use App\Domain\Vocabulary\MeaningList;
use App\Domain\Vocabulary\VO\Deep;
use App\Domain\Vocabulary\VO\EntryType;
use App\Domain\Vocabulary\VO\Level;
use App\Domain\Vocabulary\VO\Term;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Tangram\Domain\Event\DomainEventInterface;
use Tangram\Infrastructure\Api\Dto\Input;

trait EntryBase
{
	private EntryType $type;

	private Term $term;

	private Level $level;

	private Collection $meanings;

	private EntryId $id;

	public function __construct(EntryType $type, Term $term, Level $level, ?array $meanings)
	{
		$this->id = new EntryId();
		$this->meanings = new ArrayCollection();

		$this->initialize($type, $term, $level, $meanings);
		$this->notify(new EntryHasBeenCreated($this));
	}

	abstract public function notify(DomainEventInterface $domainEvent): void;

	public function update(EntryType $type, Term $term, Level $level, ?array $meanings): static
	{
		$this->initialize($type, $term, $level, $meanings);
		$this->notify(new EntryHasBeenUpdated($this));

		return $this;
	}

	private function initialize(EntryType $type, Term $term, Level $level, ?array $meanings): static
	{
		$this->type = $type;
		$this->term = $term;
		$this->level = $level;
		$this->putMeanings($meanings);

		return $this;
	}

	private function putMeanings(?iterable $meanings): static
	{
		if (is_null($meanings)) {
			return $this;
		}

		$this->meanings()
	->compareWith($meanings)
	->inserts(fn (Input $meaning) => $this->addMeaning(...$meaning))
	->removes([$this, 'removeMeaning']);

		return $this;
	}

	public function addMeaning(Term $term, Deep $deep): static
	{
		$meaning = new Meaning($this, $term, $deep);

		$this->meanings->add($meaning);

		return $this;
	}

	public function removeMeaning(Meaning $meaning): static
	{
		if (!$this->meanings->contains($meaning)) {
			return $this;
		}
		$this->meanings->removeElement($meaning);

		return $this;
	}

	public function id(): EntryId
	{
		return $this->id;
	}

	public function type(): EntryType
	{
		return $this->type;
	}

	public function term(): Term
	{
		return $this->term;
	}

	public function level(): Level
	{
		return $this->level;
	}

	public function meanings(): MeaningList
	{
		return MeaningList::collect($this->meanings);
	}
}
