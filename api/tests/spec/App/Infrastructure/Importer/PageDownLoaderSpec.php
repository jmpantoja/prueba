<?php

namespace spec\App\Infrastructure\Importer;

use App\Infrastructure\Importer\PageDownLoader;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\Adapter\NullAdapter;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class PageDownLoaderSpec extends ObjectBehavior
{
	public function let(AdapterInterface $cache, HttpClientInterface $client)
	{
		$this->beConstructedWith($cache, $client);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(PageDownLoader::class);
	}

	public function it_gets_html_from_a_website_that_it_is_cached(CacheInterface $cache)
	{
		$cache->get('url', Argument::type('callable'))
			->shouldBeCalledOnce()
			->willReturn('html content');

		$this->getHtml('url')->shouldReturn('html content');
	}

	public function it_gets_html_from_a_website_that_it_is_not_cached(HttpClientInterface $client, ResponseInterface $response)
	{
		$cache = new NullAdapter();
		$this->beConstructedWith($cache, $client);

		$response->getContent()
			->willReturn('html content');

		$client->request('GET', 'url')
		->shouldBeCalledOnce()
		->willReturn($response);

		$this->getHtml('url')->shouldReturn('html content');
	}
}
