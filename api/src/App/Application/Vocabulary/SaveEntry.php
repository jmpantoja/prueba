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

namespace App\Application\Vocabulary;

use App\Domain\Vocabulary\Entry;

final class SaveEntry
{
	private Entry $entry;

	public function __construct(Entry $entry)
	{
		$this->entry = $entry;
	}

	public function entry(): Entry
	{
		return $this->entry;
	}
}
