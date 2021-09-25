<?php

namespace spec\App\Infrastructure\Importer;

use App\Infrastructure\Importer\PageDownLoader;
use App\Infrastructure\Importer\VocabularyOneWordProvider;
use App\Infrastructure\Importer\WordProviderInterface;
use PhpSpec\ObjectBehavior;

class VocabularyOneWordProviderSpec extends ObjectBehavior
{
	public function let(PageDownLoader $downLoader)
	{
		$this->beConstructedWith($downLoader);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(VocabularyOneWordProvider::class);
		$this->shouldImplement(WordProviderInterface::class);
	}

	public function it_imports_the_words_by_level_and_page(PageDownLoader $downLoader)
	{
		$downLoader->getHtml('https://vocabulary.one/en/frequency/k01/1')
			->shouldBeCalledOnce()
			->willReturn($this->getHtml('k01_1.html'));

		$this->wordsByPageAndLevel(1, 1)
			->shouldReturn([
				['word' => 'engine', 'lang' => 'en', 'level' => 1, 'page' => 1],
				['word' => 'club', 'lang' => 'en', 'level' => 1, 'page' => 1],
				['word' => 'family', 'lang' => 'en', 'level' => 1, 'page' => 1],
				['word' => 'poor', 'lang' => 'en', 'level' => 1, 'page' => 1],
				['word' => 'plenty', 'lang' => 'en', 'level' => 1, 'page' => 1],
				['word' => 'football', 'lang' => 'en', 'level' => 1, 'page' => 1],
				['word' => 'I', 'lang' => 'en', 'level' => 1, 'page' => 1],
				['word' => 'one', 'lang' => 'en', 'level' => 1, 'page' => 1],
				['word' => 'skin', 'lang' => 'en', 'level' => 1, 'page' => 1],
				['word' => 'bed', 'lang' => 'en', 'level' => 1, 'page' => 1],
			]);
	}

	public function it_imports_the_words_by_level_and_page_distint_from_1(PageDownLoader $downLoader)
	{
		$downLoader->getHtml('https://vocabulary.one/en/frequency/k01/2')
			->shouldBeCalledOnce()
			->willReturn($this->getHtml('k01_2.html'));

		$this->wordsByPageAndLevel(1, 2)
			->shouldReturn([
				['word' => 'where', 'lang' => 'en', 'level' => 1, 'page' => 2],
				['word' => 'part', 'lang' => 'en', 'level' => 1, 'page' => 2],
				['word' => 'gun', 'lang' => 'en', 'level' => 1, 'page' => 2],
				['word' => 'movie', 'lang' => 'en', 'level' => 1, 'page' => 2],
				['word' => 'pretty', 'lang' => 'en', 'level' => 1, 'page' => 2],
				['word' => 'necessary', 'lang' => 'en', 'level' => 1, 'page' => 2],
				['word' => 'fine', 'lang' => 'en', 'level' => 1, 'page' => 2],
				['word' => 'danger', 'lang' => 'en', 'level' => 1, 'page' => 2],
				['word' => 'husband', 'lang' => 'en', 'level' => 1, 'page' => 2],
				['word' => 'hurry', 'lang' => 'en', 'level' => 1, 'page' => 2],
			]);
	}

	private function getHtml(string $key): string
	{
		$path = sprintf(__DIR__.'/data/%s', $key);

		return file_get_contents($path);
	}
}
