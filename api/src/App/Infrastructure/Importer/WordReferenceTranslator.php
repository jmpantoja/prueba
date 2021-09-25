<?php

namespace App\Infrastructure\Importer;

use DOMElement;
use Symfony\Component\DomCrawler\Crawler;
use Tangram\Domain\Lists\MixedList;

class WordReferenceTranslator implements TranslatorInterface
{
	const URL_PATTERN = 'https://www.wordreference.com/es/translation.asp?tranword=%s';
	private PageDownLoader $downLoader;

	public function __construct(PageDownLoader $downLoader)
	{
		$this->downLoader = $downLoader;
	}

	public function translate(string $word): array
	{
		$listOfMatches = $this->getListOfMatches($word);

		return MixedList::collect($listOfMatches)
			->map(function ($matches) {
				static $deep = 0;

				return [
					'meaning' => implode(', ', $matches),
					'lang' => 'es',
					'deep' => ++$deep,
				];
			})
			->values();
	}

	private function getListOfMatches(string $word): array
	{
		$key = null;
		$listOfMatches = [];

		$nodes = $this->getNodes($word);
		foreach ($nodes as $node) {
			$key = $this->key($node, $key);
			$listOfMatches[$key][] = $this->parse($node);
		}

		unset($listOfMatches['']);

		return MixedList::collect($listOfMatches)
			->map(function (array $matches) {
				return array_filter($matches);
			})
			->toArray();
	}

	/**
	 * @return DOMElement[]
	 */
	private function getNodes(string $word): iterable
	{
		$crawler = $this->getCrawler($word);

		/** @var DOMElement[] $nodes */
		$nodes = $crawler->filter('table.WRD')
			->first()
			->filter('tr');

		return $nodes;
	}

	/**
	 * @return string
	 */
	private function getCrawler(string $word): Crawler
	{
		$url = sprintf(self::URL_PATTERN, $word);
		$html = $this->downLoader->getHtml($url);

		return new Crawler($html);
	}

	private function key(DOMElement $row, ?string $last): ?string
	{
		$key = $row->getAttribute('id');
		if (strlen($key) > 0) {
			return $key;
		}

		return $last;
	}

	private function parse(DOMElement $row): ?string
	{
		$crawler = new Crawler($row);
		$lines = $crawler->filter('.ToWrd')
			->each(function (Crawler $td) {
				return $this->clear($td);
			});

		return implode(', ', $lines);
	}

	private function clear(Crawler $line): string
	{
		$text = $line->html();
		$text = preg_replace('/<em.*>.*<\/em>/', '', $text);
		$text = preg_replace('/<a.*>.*<\/a>/', '', $text);

		return trim($text);
	}

	public function audio(string $word): ?string
	{
		$crawler = $this->getCrawler($word);
		$listOfAudios = $crawler->filter('audio source')
			->each(function (Crawler $node) {
				return $node->attr('src');
			});

		usort($listOfAudios, function (string $source) {
			return preg_match('/\/general\//', $source) ? 1 : -1;
		});

		return array_pop($listOfAudios);
	}
}
