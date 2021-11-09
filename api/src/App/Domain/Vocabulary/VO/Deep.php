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

final class Deep
{
	use Assert;

	private int $deep;

	public function __construct(int $deep)
	{
		$this->assert($deep);

		$this->deep = $deep;
	}

	public function deep(): int
	{
		return $this->deep;
	}

	public function toInt(): int
	{
		return $this->deep;
	}
}
