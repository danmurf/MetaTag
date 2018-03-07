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
}
