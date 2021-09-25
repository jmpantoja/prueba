<?php

/**
 * This file is part of the planb project.
 *
 * (c) jmpantoja <jmpantoja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Infrastructure\Importer;

use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Contracts\Cache\ItemInterface;

class PageDownLoader
{
	private AdapterInterface $cache;

	public function __construct(AdapterInterface $cache)
	{
		$this->cache = $cache;
	}

	public function getHtml(string $url): string
	{
		$client = new Client();
		$key = str_replace(['/', ':'], '_', $url);

		return $this->cache->get($key, function (ItemInterface $item) use ($client, $url) {
			$response = $client->request('GET', $url);

			return $this->getContents($response->getBody());
		});
	}

	private function getContents(StreamInterface $body)
	{
		return $body->getContents();
	}
}
