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

use App\Domain\Vocabulary\MeaningId;

final class DeleteMeaning
{
	private MeaningId $meaningId;

	public function __construct(MeaningId $meaningId)
	{
		$this->meaningId = $meaningId;
	}

	public function meaningId(): MeaningId
	{
		return $this->meaningId;
	}
}
