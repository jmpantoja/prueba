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

namespace App\Infrastructure\Api\Example\Normalizer;


use App\Domain\Example\FullName;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class FullNameNormalizer implements NormalizerInterface, DenormalizerInterface
{


    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return new FullName(...[
            $data['firstName'],
            $data['lastName'],
        ]);
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return $type === FullName::class;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'firstName' => $object->firstName(),
            'lastName' => $object->lastName(),
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof FullName;
    }
}
