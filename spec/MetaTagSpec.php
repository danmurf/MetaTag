<?php

namespace spec\danmurf;

use danmurf\MetaTag;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MetaTagSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MetaTag::class);
    }

    function it_can_set_no_index()
    {
        $this->setNoIndex(true)->shouldReturn($this);
    }
}
