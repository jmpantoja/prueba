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

final class Duration
{
	use Assert;

	private int $minutes;

	private int $seconds;

	public function __construct(int $minutes, int $seconds)
	{
		$this->assert(get_defined_vars());

		$this->minutes = $minutes;
		$this->seconds = $seconds;
	}

	public function minutes(): int
	{
		return $this->minutes;
	}

	public function seconds(): int
	{
		return $this->seconds;
	}
}
