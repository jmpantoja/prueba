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

namespace App\Infrastructure\UI\Symfony\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class BorrameController extends AbstractController
{
	public function __invoke(Request $request)
	{
		$response = new JsonResponse([
			'date' => (new DateTime())->format('H.i.s'),
			'method' => $request->getMethod(),
		]);

		$date = new DateTime();

		//        $response->setMaxAge(600);
		//        $response->setLastModified($date);

		$response->setSharedMaxAge(600);
		//  $response->setVary('Authorization');

		return $response;
	}
}
