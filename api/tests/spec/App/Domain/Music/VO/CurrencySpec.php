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

namespace spec\App\Domain\Music\VO;

use App\Domain\Music\VO\Currency;
use PhpSpec\ObjectBehavior;

final class CurrencySpec extends ObjectBehavior
{
	private const VALUES = [
			'EURO' => 'euro',
			'DOLLAR' => 'dollar',
		];

	public function let()
	{
		$values = array_values(self::VALUES);
		$value = array_pop($values);

		$this->beConstructedThrough('from', [$value]);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(Currency::class);
	}

	public function it_is_a_enum_with_values()
	{
		$this::toArray()->shouldReturn(self::VALUES);
	}
}
