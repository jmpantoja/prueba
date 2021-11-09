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

use App\Domain\Vocabulary\VO\AudioPath;
use PhpSpec\ObjectBehavior;
use Tangram\Domain\Assertion\Exception\AssertException;

final class AudioPathSpec extends ObjectBehavior
{
	public function let()
	{
		$this->beConstructedWith('/path/to/audio.mp3');
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(AudioPath::class);
	}

	public function it_fails_when_arguments_are_wrong()
	{
		$this->beConstructedWith('/path/to/no-es-audio.jpg');
		$this->shouldThrow(AssertException::class)->duringInstantiation();
	}

	public function it_gets_properties_properly()
	{
		$this->path()->shouldReturn('/path/to/audio.mp3');

		$this->__toString()->shouldReturn('/path/to/audio.mp3');
	}
}
