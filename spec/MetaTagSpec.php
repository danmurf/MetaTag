<?php

namespace spec\danmurf;

use danmurf\MetaTag;
use PhpSpec\ObjectBehavior;

class MetaTagSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(MetaTag::class);
    }

    public function it_can_set_no_index()
    {
        $this->setNoIndex(true)->shouldReturn($this);
    }

    public function it_can_set_keywords()
    {
        $this->setKeywords([])->shouldReturn($this);
    }

    public function it_can_set_description()
    {
        $this->setDescription('Some description')->shouldReturn($this);
    }

    public function it_can_set_author()
    {
        $this->setAuthor('Jessie Wongus')->shouldReturn($this);
    }

    public function it_can_set_canonical_url()
    {
        $this->setCanonicalUrl('http://example.com')->shouldReturn($this);
    }

    public function it_can_render_no_index()
    {
        $this->renderNoIndex()->shouldReturn(null);

        $this->setNoindex(true);

        $expectedResult = '<meta name="robots" content="noindex, noarchive, nofollow">'."\n";
        $this->renderNoIndex()->shouldReturn($expectedResult);
    }

    public function it_can_render_keywords()
    {
        $this->renderKeywords()->shouldReturn(null);

        $this->setKeywords(['first', 'second', 'third']);

        $expectedResult = '<meta name="keywords" content="first, second, third">'."\n";
        $this->renderKeywords()->shouldReturn($expectedResult);
    }

    public function it_can_render_description()
    {
        $this->renderDescription()->shouldReturn(null);

        $this->setDescription('This is a description of the webpage.');
        $expectedResult =
        '<meta name="description" content="This is a description of the webpage.">'."\n";
        $this->renderDescription()->shouldReturn($expectedResult);
    }

    public function it_can_render_author()
    {
        $this->renderAuthor()->shouldReturn(null);

        $this->setAuthor('Jessie Wongus');
        $expectedResult = '<meta name="author" content="Jessie Wongus">'."\n";
        $this->renderAuthor()->shouldReturn($expectedResult);
    }

    public function it_can_render_canonical_url()
    {
        $this->renderCanonicalUrl()->shouldReturn(null);

        $this->setCanonicalUrl('https://www.example.com/testing?q=hello-world');
        $expectedResult = '<link rel="canonical" href="https://www.example.com/testing?q=hello-world">'."\n";
        $this->renderCanonicalUrl()->shouldReturn($expectedResult);
    }

    public function it_can_properly_sanitise_content()
    {
        $dirtyContent = 'Here is a string with "double quotes" <tags> and a new
        line';

        $expectedResult = '<meta name="description" content="Here is a string with double quotes and a new line">'."\n";
        $this->setDescription($dirtyContent);
        $this->renderDescription()->shouldReturn($expectedResult);
    }

    public function it_can_render_all_tags_together()
    {
        $this->setNoIndex(true)
            ->setKeywords(['first', 'second', 'third'])
            ->setDescription('This is a description of the webpage.')
            ->setAuthor('Jessie Wongus')
            ->setCanonicalUrl('https://www.example.com/testing?q=hello-world');

        $expectedResult = '<meta name="robots" content="noindex, noarchive, nofollow">'."\n";
        $expectedResult .= '<meta name="keywords" content="first, second, third">'."\n";
        $expectedResult .= '<meta name="description" content="This is a description of the webpage.">'."\n";
        $expectedResult .= '<meta name="author" content="Jessie Wongus">'."\n";
        $expectedResult .= '<link rel="canonical" href="https://www.example.com/testing?q=hello-world">'."\n";

        $this->render()->shouldReturn($expectedResult);
    }

    public function it_can_indent_rendered_tags()
    {
        $this->setNoIndex(true)
        ->setKeywords(['first', 'second', 'third'])
        ->setDescription('This is a description of the webpage.')
        ->setAuthor('Jessie Wongus')
        ->setCanonicalUrl('https://www.example.com/testing?q=hello-world');

        $expectedResult = '    <meta name="robots" content="noindex, noarchive, nofollow">'."\n";
        $expectedResult .= '    <meta name="keywords" content="first, second, third">'."\n";
        $expectedResult .= '    <meta name="description" content="This is a description of the webpage.">'."\n";
        $expectedResult .= '    <meta name="author" content="Jessie Wongus">'."\n";
        $expectedResult .= '    <link rel="canonical" href="https://www.example.com/testing?q=hello-world">'."\n";

        $this->render(4)->shouldReturn($expectedResult);
    }
}
