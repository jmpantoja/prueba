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

use App\Domain\Vocabulary\Meaning;

final class SaveMeaning
{
	private Meaning $meaning;

	public function __construct(Meaning $meaning)
	{
		$this->meaning = $meaning;
	}

	public function meaning(): Meaning
	{
		return $this->meaning;
	}
}
