<?php

namespace spec\App\Domain\Vocabulary;

use App\Domain\Vocabulary\Meaning;
use App\Domain\Vocabulary\MeaningList;
use App\Domain\Vocabulary\VO\Lang;
use App\Domain\Vocabulary\VO\Term;
use PhpSpec\ObjectBehavior;

class MeaningListSpec extends ObjectBehavior
{
	public function let()
	{
		$this->beConstructedThrough('collect', []);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(MeaningList::class);
		$this->type()->shouldReturn(Meaning::class);
	}

	public function it_creates_a_hash(Meaning $meaning)
	{
		$meaning->term()->willReturn(new Term('palabra', Lang::SPANISH()));
		$this->hash($meaning)->shouldReturn('palabra-es');
	}
}
