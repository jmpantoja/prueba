<?php

namespace spec\App\Infrastructure\Importer;

use App\Domain\Vocabulary\VO\Level;
use App\Infrastructure\Importer\CacheNullStorage;
use App\Infrastructure\Importer\StorageInterface;
use App\Infrastructure\Importer\TranslatorInterface;
use App\Infrastructure\Importer\WordGenerator;
use App\Infrastructure\Importer\WordProviderInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WordGeneratorSpec extends ObjectBehavior
{
	public function let(WordProviderInterface $wordProvider, TranslatorInterface $translator, StorageInterface $cache)
	{
		$this->beConstructedWith($wordProvider, $translator, $cache);
	}

	public function it_is_initializable()
	{
		$this->shouldHaveType(WordGenerator::class);
	}

	public function it_import_a_level_that_it_is_cached(WordProviderInterface $wordProvider, TranslatorInterface $translator, StorageInterface $cache)
	{
		$level = new Level(1, 1);
		$response = $this->response();

		$wordProvider->wordsByLevel(Argument::any())->shouldNotBeCalled();
		$translator->translate(Argument::any())->shouldNotBeCalled();
		$translator->audio(Argument::any())->shouldNotBeCalled();

		$cache->get($level->key(), Argument::type('callable'))
			->shouldBeCalledOnce()
			->willReturn($response);

		$this->import($level)
			->shouldReturn($response);
	}

	public function it_import_a_level_that_it_is_not_cached(WordProviderInterface $wordProvider, TranslatorInterface $translator)
	{
		$cache = new CacheNullStorage();
		$this->beConstructedWith($wordProvider, $translator, $cache);

		$level = new Level(1, 1);

		$wordProvider->wordsByLevel(Argument::exact($level))->shouldBeCalledOnce();
		$translator->translate(Argument::any())->shouldBeCalled();
		$translator->audio(Argument::any())->shouldBeCalled();

		$this->configureProvider($wordProvider, $level);
		$this->configureTranslator($translator);

		$this->import($level)
			->shouldReturn($this->response());
	}

	/**
	 * @param \PhpSpec\Wrapper\Collaborator|WordProviderInterface $wordProvider
	 */
	private function configureProvider(\PhpSpec\Wrapper\Collaborator|WordProviderInterface $wordProvider, Level $level): void
	{
		$wordProvider->wordsByLevel($level)
			->willReturn([
				['word' => 'engine', 'lang' => 'en', 'level' => 1, 'page' => 1, 'audio' => 'http://engine'],
				['word' => 'club', 'lang' => 'en', 'level' => 1, 'page' => 1, 'audio' => 'http://club'],
				['word' => 'family', 'lang' => 'en', 'level' => 1, 'page' => 1, 'audio' => 'http://family'],
			]);
	}

	/**
	 * @param TranslatorInterface|\PhpSpec\Wrapper\Collaborator $translator
	 */
	private function configureTranslator(TranslatorInterface|\PhpSpec\Wrapper\Collaborator $translator): void
	{
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
	}

	/**
	 * @return array[]
	 */
	private function response(): array
	{
		return [
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
		];
	}
}
