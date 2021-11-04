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

namespace App\Infrastructure\Doctrine\DBAL\Type\Vocabulary;

use App\Infrastructure\Api\Vocabulary\Normalizer\LangNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Tangram\Infrastructure\Doctrine\DBAL\Type\EnumType;

final class LangDBALType extends EnumType
{
	public static function name(): string
	{
		return 'Lang';
	}

	public function normalizer(): NormalizerInterface|DenormalizerInterface
	{
		return new LangNormalizer();
	}
}