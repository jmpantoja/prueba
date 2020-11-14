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

namespace App\Infrastructure\Api\Example;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Application\Example\Dto\ContactDto;
use App\Domain\Example\Contact;
use App\Domain\Example\FullName;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class ContactInputTransformer implements DataTransformerInterface
{

    private ObjectNormalizer $itemNormalizer;

    public function __construct(ObjectNormalizer $itemNormalizer)
    {
        $this->itemNormalizer = $itemNormalizer;
    }

    /**
     * @param ContactDto $object
     * @param string $to
     * @param array $context
     * @return object|void
     */
    public function transform($object, string $to, array $context = [])
    {
        $fullName = $this->itemNormalizer->denormalize($object->fullName, FullName::class);

        return new Contact($fullName, $object->birthDate);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === Contact::class;
    }
}
