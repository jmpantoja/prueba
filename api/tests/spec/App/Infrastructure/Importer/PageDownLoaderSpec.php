<?php

namespace spec\App\Infrastructure\Importer;

use App\Infrastructure\Importer\PageDownLoader;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Cache\Adapter\ChainAdapter;

class PageDownLoaderSpec extends ObjectBehavior
{
	public function let(ChainAdapter $cache)
	{
		$this->beConstructedWith($cache);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(PageDownLoader::class);
	}

	public function it_gets_html_from_a_website(ChainAdapter $cache)
	{
		$cache->get('url', Argument::type('callable'))
			->shouldBeCalledOnce()
			->willReturn('html content');

		$this->getHtml('url')->shouldReturn('html content');
	}
}
