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

final class Year
{
	use Assert;

	private int $name;

	public function __construct(int $name)
	{
		$this->assert(get_defined_vars());

		$this->name = $name;
	}

	public function name(): int
	{
		return $this->name;
	}

	public function toInt(): int
	{
		return $this->name;
	}
}
