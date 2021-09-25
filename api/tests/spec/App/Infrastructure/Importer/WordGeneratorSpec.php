<?php

namespace spec\App\Infrastructure\Importer;

use App\Infrastructure\Importer\TranslatorInterface;
use App\Infrastructure\Importer\WordGenerator;
use App\Infrastructure\Importer\WordProviderInterface;
use PhpSpec\ObjectBehavior;

class WordGeneratorSpec extends ObjectBehavior
{
	public function let(WordProviderInterface $wordProvider, TranslatorInterface $translator)
	{
		$this->beConstructedWith($wordProvider, $translator);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(WordGenerator::class);
	}

	public function it_generate_a_page_or_words(WordProviderInterface $wordProvider, TranslatorInterface $translator)
	{
		$wordProvider->wordsByPageAndLevel(1, 1)
			->willReturn([
				['word' => 'engine', 'lang' => 'en', 'level' => 1, 'page' => 1, 'audio' => 'http://engine'],
				['word' => 'club', 'lang' => 'en', 'level' => 1, 'page' => 1, 'audio' => 'http://club'],
				['word' => 'family', 'lang' => 'en', 'level' => 1, 'page' => 1, 'audio' => 'http://family'],
			]);

		$translator->translate('engine')
			->willReturn([
				['meaning' => 'motor', 'lang' => 'es', 'deep' => 1],
				['meaning' => 'camión de bomberos', 'lang' => 'es', 'deep' => 2],
			]);

		$translator->audio('engine')
			->willReturn('http://engine');

		$translator->translate('club')
			->willReturn([
				['meaning' => 'club', 'lang' => 'es', 'deep' => 1],
				['meaning' => 'palo de golf, palo', 'lang' => 'es', 'deep' => 2],
				['meaning' => 'garrote, porra', 'lang' => 'es', 'deep' => 3],
			]);

		$translator->audio('club')
			->willReturn('http://club');

		$translator->translate('family')
			->willReturn([
				['meaning' => 'familia', 'lang' => 'es', 'deep' => 1],
			]);

		$translator->audio('family')
			->willReturn('http://family');

		$this->import(1, 1)
			->shouldReturn([
				['word' => 'engine', 'lang' => 'en', 'level' => 1, 'page' => 1, 'audio' => 'http://engine', 'meanings' => [
					['meaning' => 'motor', 'lang' => 'es', 'deep' => 1],
					['meaning' => 'camión de bomberos', 'lang' => 'es', 'deep' => 2],
				]],
				['word' => 'club', 'lang' => 'en', 'level' => 1, 'page' => 1, 'audio' => 'http://club', 'meanings' => [
					['meaning' => 'club', 'lang' => 'es', 'deep' => 1],
					['meaning' => 'palo de golf, palo', 'lang' => 'es', 'deep' => 2],
					['meaning' => 'garrote, porra', 'lang' => 'es', 'deep' => 3],
				]],
				['word' => 'family', 'lang' => 'en', 'level' => 1, 'page' => 1, 'audio' => 'http://family', 'meanings' => [
					['meaning' => 'familia', 'lang' => 'es', 'deep' => 1],
				]],
			]);
	}
}
