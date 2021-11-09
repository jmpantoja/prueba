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

use App\Domain\Vocabulary\Input\EntryInput;
use App\Domain\Vocabulary\MeaningList;
use App\Domain\Vocabulary\VO\AudioPath;
use App\Domain\Vocabulary\VO\EntryType;
use App\Domain\Vocabulary\VO\Lang;
use App\Domain\Vocabulary\VO\Level;
use App\Domain\Vocabulary\VO\Term;
use PhpSpec\ObjectBehavior;

final class EntryInputSpec extends ObjectBehavior
{
	public function input(): array
	{
		return [
			'type' => EntryType::WORD(),
			'term' => new Term('term', Lang::ENGLISH()),
			'level' => new Level(1, 1),
			'audio' => new AudioPath('/path/to/audio.mp3'),
			'meanings' => [],
		];
	}

	public function let()
	{
		$this->beConstructedThrough('fromArray', [$this->input()]);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(EntryInput::class);
	}

	public function it_gets_type_properly()
	{
		$input = $this->input();

		$this->type()->shouldBeLike($input['type']);
	}

	public function it_gets_term_properly()
	{
		$input = $this->input();

		$this->term()->shouldBeLike($input['term']);
	}

	public function it_gets_level_properly()
	{
		$input = $this->input();

		$this->level()->shouldBeLike($input['level']);
	}

	public function it_gets_audio_properly()
	{
		$input = $this->input();

		$this->audio()->shouldBeLike($input['audio']);
	}

	public function it_gets_meanings_properly()
	{
		$input = $this->input();

		$this->meanings()->shouldBeLike(MeaningList::collect($input['meanings']));
	}
}
