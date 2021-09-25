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

namespace App\Domain\Music\VO;

use Tangram\Domain\Assertion\Traits\Assert;

final class Position
{
	use Assert;

	private int $position;

	public function __construct(int $position)
	{
		$this->assert(get_defined_vars());

		$this->position = $position;
	}

	public function position(): int
	{
		return $this->position;
	}

	public function toInt(): int
	{
		return $this->position;
	}
}
