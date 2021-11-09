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

use App\Domain\Vocabulary\VO\Level;
use PhpSpec\ObjectBehavior;
use Tangram\Domain\Assertion\Exception\AssertException;

final class LevelSpec extends ObjectBehavior
{
	public function let()
	{
		$this->beConstructedWith(1, 5);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(Level::class);
	}

	public function it_fails_when_level_is_less_than_1()
	{
		$this->beConstructedWith(-1, 10);
		$this->shouldThrow(AssertException::class)->duringInstantiation();
	}

	public function it_fails_when_level_is_greather_than_20()
	{
		$this->beConstructedWith(21, 10);
		$this->shouldThrow(AssertException::class)->duringInstantiation();
	}

	public function it_fails_when_page_is_less_than_1()
	{
		$this->beConstructedWith(1, 0);
		$this->shouldThrow(AssertException::class)->duringInstantiation();
	}

	public function it_fails_when_page_is_greather_than_100()
	{
		$this->beConstructedWith(1, 101);
		$this->shouldThrow(AssertException::class)->duringInstantiation();
	}

	public function it_gets_properties_properly()
	{
		$this->level()->shouldReturn(1);
		$this->page()->shouldReturn(5);
	}

	public function it_gets_key_properly()
	{
		$this->key()->shouldReturn('K0105');
	}

	public function it_gets_next_properly()
	{
		$next = $this->next();
		$next->level()->shouldReturn(1);
		$next->page()->shouldReturn(6);
	}

	public function it_gets_next_properly_when_page_is_10()
	{
		$this->beConstructedWith(1, 100);
		$next = $this->next();
		$next->level()->shouldReturn(2);
		$next->page()->shouldReturn(1);
	}

	public function it_gets_next_properly_when_level_is_20_and_page_is_10()
	{
		$this->beConstructedWith(20, 100);
		$this->next()->shouldReturn(null);
	}
}
