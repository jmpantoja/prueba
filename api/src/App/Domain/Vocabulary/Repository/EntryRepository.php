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

namespace App\Domain\Vocabulary\Repository;

use App\Domain\Vocabulary\Entry;
use App\Domain\Vocabulary\EntryId;

interface EntryRepository
{
	public function save(Entry $entry);

	public function delete(EntryId $entryId);

	public function findById(EntryId $entryId): ?Entry;
}
