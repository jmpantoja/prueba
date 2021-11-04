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

use App\Domain\Vocabulary\VO\Term;
use PhpSpec\Exception\Example\PendingException;
use PhpSpec\ObjectBehavior;
use Tangram\Domain\Assertion\Exception\AssertException;

final class TermSpec extends ObjectBehavior
{
	public function let()
	{
		throw new PendingException('pasar arguementos al constructor');
		$this->beConstructedWith();
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(Term::class);
	}

	public function it_fails_when_arguments_are_wrong()
	{
		throw new PendingException('Este test debe comprobar que funcionan los constraints');
		$this->beConstructedWith(/*bad arguments*/);
		$this->shouldThrow(AssertException::class)->duringInstantiation();
	}

	public function it_gets_properties_properly()
	{
		throw new PendingException('Este test debe comprobar que funcionan los getters');
	}
}
