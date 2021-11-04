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

namespace spec\App\Domain\Vocabulary\VO;

use App\Domain\Vocabulary\VO\Lang;
use PhpSpec\ObjectBehavior;

final class LangSpec extends ObjectBehavior
{
	private const VALUES = [
			'SPANISH' => 'es',
			'ENGLISH' => 'en',
		];

	public function let()
	{
		$values = array_values(self::VALUES);
		$value = array_pop($values);

		$this->beConstructedThrough('from', [$value]);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(Lang::class);
	}

	public function it_is_a_enum_with_values()
	{
		$this::toArray()->shouldReturn(self::VALUES);
	}
}
