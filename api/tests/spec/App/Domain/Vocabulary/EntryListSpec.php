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

namespace spec\App\Domain\Vocabulary;

use App\Domain\Vocabulary\Entry;
use App\Domain\Vocabulary\EntryList;
use App\Domain\Vocabulary\VO\Lang;
use App\Domain\Vocabulary\VO\Term;
use PhpSpec\ObjectBehavior;

final class EntryListSpec extends ObjectBehavior
{
	public function let()
	{
		$this->beConstructedThrough('collect', []);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(EntryList::class);
		$this->type()->shouldReturn(Entry::class);
	}

	public function it_creates_a_hash(Entry $entry)
	{
		$entry->term()->willReturn(new Term('palabra', Lang::SPANISH()));
		$this->hash($entry)->shouldReturn('palabra-es');
	}
}
