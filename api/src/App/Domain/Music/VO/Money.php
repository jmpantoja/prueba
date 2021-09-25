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

final class Money
{
	use Assert;

	private int $amount;

	private Currency $currency;

	public function __construct(int $amount, Currency $currency)
	{
		$this->assert(get_defined_vars());

		$this->amount = $amount;
		$this->currency = $currency;
	}

	public function amount(): int
	{
		return $this->amount;
	}

	public function currency(): Currency
	{
		return $this->currency;
	}
}
