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

namespace App\Domain\Vocabulary\Input;

use App\Domain\Vocabulary\MeaningList;
use App\Domain\Vocabulary\VO\EntryType;
use App\Domain\Vocabulary\VO\Level;
use App\Domain\Vocabulary\VO\Term;
use Tangram\Infrastructure\Api\Dto\Input;

final class EntryInput extends Input
{
	public EntryType $type;
	public Term $term;
	public Level $level;
	/**
	 * @var MeaningInput[]
	 */
	public ?array $meanings = null;

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
