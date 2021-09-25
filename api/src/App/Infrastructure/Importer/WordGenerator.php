<?php

namespace App\Infrastructure\Importer;

use Tangram\Domain\Lists\MixedList;

class WordGenerator
{
	private WordProviderInterface $provider;
	private TranslatorInterface $translator;

	public function __construct(WordProviderInterface $provider, TranslatorInterface $translator)
	{
		$this->provider = $provider;
		$this->translator = $translator;
	}

	public function import(int $level, int $page)
	{
		$wordList = $this->provider->wordsByPageAndLevel($level, $page);

		return MixedList::collect($wordList)
			->map(fn (array $row) => $this->addAudioToRow($row))
			->map(fn (array $row) => $this->addMeaningsToRow($row))
			->toArray();
	}

	private function addAudioToRow(array $row)
	{
		$row['audio'] = $this->translator->audio($row['word']);

		return $row;
	}

	private function addMeaningsToRow(array $row)
	{
		$row['meanings'] = $this->translator->translate($row['word']);

		return $row;
	}
}
