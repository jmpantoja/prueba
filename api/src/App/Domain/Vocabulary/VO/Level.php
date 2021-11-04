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

namespace App\Domain\Vocabulary\VO;

use Tangram\Domain\Assertion\Traits\Assert;

final class Level
{
	use Assert;

	private int $level;

	private int $page;

	public function __construct(int $level, int $page)
	{
		$this->assert(get_defined_vars());

		$this->level = $level;
		$this->page = $page;
	}

	public function level(): int
	{
		return $this->level;
	}

	public function page(): int
	{
		return $this->page;
	}
}
