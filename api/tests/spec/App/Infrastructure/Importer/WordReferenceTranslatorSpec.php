<?php

namespace spec\App\Infrastructure\Importer;

use App\Infrastructure\Importer\PageDownLoader;
use App\Infrastructure\Importer\TranslatorInterface;
use App\Infrastructure\Importer\WordReferenceTranslator;
use PhpSpec\ObjectBehavior;

class WordReferenceTranslatorSpec extends ObjectBehavior
{
	public function let(PageDownLoader $downLoader)
	{
		$this->beConstructedWith($downLoader);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(WordReferenceTranslator::class);
		$this->shouldImplement(TranslatorInterface::class);
	}

	public function it_gets_meanings_of_a_word(PageDownLoader $downLoader)
	{
		$downLoader->getHtml('https://www.wordreference.com/es/translation.asp?tranword=engine')
			->shouldBeCalledOnce()
			->willReturn($this->getHtml('engine.html'));

		$this->translate('engine')
		->shouldReturn([
			['meaning' => 'motor', 'lang' => 'es', 'deep' => 1],
			['meaning' => 'camión de bomberos', 'lang' => 'es', 'deep' => 2],
			['meaning' => 'locomotora, máquina', 'lang' => 'es', 'deep' => 3],
		]);
	}

	public function it_gets_audio_of_a_word(PageDownLoader $downLoader)
	{
		$downLoader->getHtml('https://www.wordreference.com/es/translation.asp?tranword=engine')
			->shouldBeCalledOnce()
			->willReturn($this->getHtml('engine.html'));

		$this->audio('engine')
			->shouldReturn('/audio/en/uk/general/en029903.mp3');
	}

	private function getHtml(string $key): string
	{
		$path = sprintf(__DIR__.'/data/%s', $key);

		return file_get_contents($path);
	}
}
