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

namespace spec\App\Domain\Vocabulary\Input;

use App\Domain\Vocabulary\Entry;
use App\Domain\Vocabulary\Input\MeaningInput;
use App\Domain\Vocabulary\VO\Deep;
use App\Domain\Vocabulary\VO\Lang;
use App\Domain\Vocabulary\VO\Term;
use PhpSpec\ObjectBehavior;

final class MeaningInputSpec extends ObjectBehavior
{
	public function input(Entry $entry): array
	{
		return [
			'entry' => $entry,
			'term' => new Term('palabra', Lang::ENGLISH()),
			'deep' => new Deep(1),
		];
	}

	public function let(Entry $entry)
	{
		$this->beConstructedThrough('fromArray', [$this->input($entry)]);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(MeaningInput::class);
	}

	public function it_gets_entry_properly(Entry $entry)
	{
		$input = $this->input($entry);

		$this->entry()->shouldBeLike($input['entry']);
	}

	public function it_gets_term_properly(Entry $entry)
	{
		$input = $this->input($entry);

		$this->term()->shouldBeLike($input['term']);
	}

	public function it_gets_deep_properly(Entry $entry)
	{
		$input = $this->input($entry);

		$this->deep()->shouldBeLike($input['deep']);
	}
}
