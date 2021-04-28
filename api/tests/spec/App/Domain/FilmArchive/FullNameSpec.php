<?php

namespace spec\App\Domain\FilmArchive;

use App\Domain\FilmArchive\FullName;
use PhpSpec\ObjectBehavior;

class FullNameSpec extends ObjectBehavior
{
    public function let(){
        $this->beConstructedWith('pepe', 'lopez');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(FullName::class);
    }
}
