<?php

namespace spec\Tangram\Domain\ValueObject\FullName;

use PhpSpec\ObjectBehavior;
use Tangram\Domain\ValueObject\FullName;

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
