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

use App\Infrastructure\Api\Vocabulary\Normalizer\DeepNormalizer;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Tangram\Infrastructure\Doctrine\DBAL\Type\ValueObjectType;

final class DeepDBALType extends ValueObjectType
{
	public function getSQLDeclaration(array $column, AbstractPlatform $platform)
	{
		return $platform->getIntegerTypeDeclarationSQL($column);
	}

	public static function name(): string
	{
		return 'Deep';
	}

	public function normalizer(): NormalizerInterface|DenormalizerInterface
	{
		return new DeepNormalizer();
	}
}
