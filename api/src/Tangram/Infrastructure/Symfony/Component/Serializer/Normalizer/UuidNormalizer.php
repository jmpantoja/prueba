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

namespace Tangram\Infrastructure\Symfony\Component\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Tangram\Domain\Lists\EntityId;

final class UuidNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private const supportedTypes = [
        EntityId::class,
    ];

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return EntityId::fromString($data);
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return in_array($type, self::supportedTypes);
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return (string)$object;
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof EntityId;
    }
}
