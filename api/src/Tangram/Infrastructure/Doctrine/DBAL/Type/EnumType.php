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

namespace Tangram\Infrastructure\Doctrine\DBAL\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;

abstract class EnumType extends ValueObjectType
{
	/**
	 * @var string
	 */
	const NAME = 'Enum';

	public function getSQLDeclaration(array $column, AbstractPlatform $platform)
	{
		return $platform->getVarcharTypeDeclarationSQL($column);
	}
}
