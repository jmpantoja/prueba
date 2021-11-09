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

namespace App\Infrastructure\Api\Vocabulary\Output;

use App\Domain\Vocabulary\Entry;
use App\Domain\Vocabulary\EntryId;
use App\Domain\Vocabulary\MeaningList;
use App\Domain\Vocabulary\VO\AudioPath;
use App\Domain\Vocabulary\VO\EntryType;
use App\Domain\Vocabulary\VO\Level;
use App\Domain\Vocabulary\VO\Term;

final class EntryOutput
{
	public EntryId $id;

	public EntryType $type;

	public Term $term;

	public Level $level;

	public AudioPath $audio;

	public MeaningList $meanings;

	public static function make(Entry $entry): self
	{
		return new self($entry);
	}

	private function __construct(Entry $entry)
	{
		$this->id = $entry->id();
		$this->type = $entry->type();
		$this->term = $entry->term();
		$this->level = $entry->level();
		$this->audio = $entry->audio();
		$this->meanings = $entry->meanings();
	}
}
