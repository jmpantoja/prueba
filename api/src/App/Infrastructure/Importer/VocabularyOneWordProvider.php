<?php

namespace App\Infrastructure\Importer;

use DOMElement;
use Symfony\Component\DomCrawler\Crawler;
use Tangram\Domain\Lists\MixedList;

class VocabularyOneWordProvider implements WordProviderInterface
{
	const URL_PATTERN = 'https://vocabulary.one/en/frequency/k%02s/%d';
	private PageDownLoader $downLoader;

	public function __construct(PageDownLoader $downLoader)
	{
		$this->downLoader = $downLoader;
	}

	public function wordsByPageAndLevel(int $level, int $page): array
	{
		$nodes = $this->getNodes($level, $page);

		return MixedList::collect($nodes)
			->map(fn (DOMElement $node) => $this->nodeToArray($node, $level, $page))
			->toArray();
	}

	/**
	 * @return object|Crawler
	 */
	private function getNodes(int $level, int $page): Crawler
	{
		$url = sprintf(self::URL_PATTERN, $level, $page);
		$html = $this->downLoader->getHtml($url);

		$crawler = new Crawler($html);

		$nodes = $crawler->filter('.highlight span');

		return $nodes;
	}

	/**
	 * @return array
	 */
	private function nodeToArray(DOMElement $node, int $level, int $page)
	{
		$word = $node->nodeValue;

		return [
			'word' => $word,
			'lang' => 'en',
			'level' => $level,
			'page' => $page,
		];
	}
}
