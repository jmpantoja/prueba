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

use Carbon\CarbonImmutable;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TimeImmutableType;

/**
 * Class CarbonTimeImmutableType.
 */
class CarbonTimeImmutableType extends TimeImmutableType
{
	private const NAME = 'carbon_time_immutable';

	/**
	 * @return string
	 */
	public function getName()
	{
		return static::NAME;
	}

	/**
	 * @param mixed $value
	 *
	 * @return CarbonImmutable|\DateTime|\DateTimeImmutable|false|mixed
	 *
	 * @throws \Doctrine\DBAL\Types\ConversionException
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		$result = parent::convertToPHPValue($value, $platform);

		if ($result instanceof \DateTimeInterface) {
			return CarbonImmutable::instance($result)->setDate(0, 0, 0);
		}

		return $result;
	}

	/**
	 * @return bool
	 */
	public function requiresSQLCommentHint(AbstractPlatform $platform)
	{
		return true;
	}
}
