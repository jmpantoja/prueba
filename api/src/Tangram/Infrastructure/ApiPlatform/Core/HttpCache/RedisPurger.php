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

namespace Tangram\Infrastructure\ApiPlatform\Core\HttpCache;

use ApiPlatform\Core\HttpCache\PurgerInterface;
use GuzzleHttp\ClientInterface;

final class RedisPurger implements PurgerInterface
{
	private ClientInterface $client;

	public function __construct($client)
	{
		$this->client = $client;
	}

	public function purge(array $iris)
	{
		if (!$iris) {
			return;
		}

		// Create the regex to purge all tags in just one request
		$parts = array_map(static function ($iri) {
			return sprintf('%s', $iri);
		}, $iris);

		$this->client->request('BAN', '', [
			'headers' => [
				'Ban-Keys' => $parts,
			],
		]);
	}
}
