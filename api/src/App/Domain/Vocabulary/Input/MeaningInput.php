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

use App\Domain\Vocabulary\Entry;
use App\Domain\Vocabulary\VO\Deep;
use App\Domain\Vocabulary\VO\Term;
use Tangram\Infrastructure\Api\Dto\Input;

final class MeaningInput extends Input
{
	public Entry $entry;
	public Term $term;
	public Deep $deep;

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
