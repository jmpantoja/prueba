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

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class CarbonNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private const supportedTypes = [
        CarbonImmutable::class,
        Carbon::class,
    ];

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return forward_static_call([$type, 'make'], $data);
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return in_array($type, static::supportedTypes);
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return $object->format('c');
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof CarbonInterface;
    }
}
