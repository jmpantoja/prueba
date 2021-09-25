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
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

abstract class ValueObjectType extends Type
{
	/**
	 * @var string
	 */
	const NAME = 'VO';

	/**
	 * {@inheritdoc}
	 *
	 * @param mixed $value
	 *
	 * @throws ConversionException
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		return static::normalizer()->denormalize($value, static::name());
	}

	/**
	 * {@inheritdoc}
	 *
	 * @param mixed $value
	 *
	 * @throws ConversionException
	 */
	public function convertToDatabaseValue($value, AbstractPlatform $platform)
	{
		return static::normalizer()->normalize($value);
	}

	/**
	 * {@inheritdoc}
	 *
	 * @return string
	 */
	public function getName()
	{
		return static::name();
	}

	abstract public static function name(): string;

	/**
	 * {@inheritdoc}
	 *
	 * @return bool
	 */
	public function requiresSQLCommentHint(AbstractPlatform $platform)
	{
		return true;
	}

	/**
	 * @param string $value
	 *
	 * @return EntityId
	 */
	abstract public function normalizer(): NormalizerInterface | DenormalizerInterface;
}
