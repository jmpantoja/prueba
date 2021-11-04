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

use App\Domain\Vocabulary\Meaning;
use App\Domain\Vocabulary\MeaningId;

interface MeaningRepository
{
	public function save(Meaning $meaning);

	public function delete(MeaningId $meaningId);

	public function findById(MeaningId $meaningId): ?Meaning;
}
