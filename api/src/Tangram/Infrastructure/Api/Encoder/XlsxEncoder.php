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

namespace Tangram\Infrastructure\Api\Encoder;

use Symfony\Component\Serializer\Encoder\EncoderInterface;
use XLSXWriter;

final class XlsxEncoder implements EncoderInterface
{
	public function encode($data, string $format, array $context = [])
	{
		$writer = new XLSXWriter();
		if (empty($data)) {
			$writer->writeSheet([]);

			return $writer->writeToString();
		}

		$headers = array_keys($data[0]);

		$types = array_fill(0, count($headers), 'string');
		$widths = array_fill(0, count($headers), 20);

		$writer->writeSheetHeader('Hoja1', $types, ['widths' => $widths, 'suppress_row' => true]);

		$style = ['font-style' => 'bold', 'fill' => '#eee', 'halign' => 'center', 'border' => 'bottom'];
		$writer->writeSheetRow('Hoja1', $headers, $style);

		foreach ($data as $row) {
			$writer->writeSheetRow('Hoja1', $row, ['height' => 15]);
		}

		return $writer->writeToString();
	}

	public function supportsEncoding(string $format)
	{
		return in_array($format, ['xlsx', 'xls']);
	}
}
