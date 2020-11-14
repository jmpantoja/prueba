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
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class ContactOutputTransformer implements DataTransformerInterface
{

    private ObjectNormalizer $itemNormalizer;

    public function __construct(ObjectNormalizer $itemNormalizer)
    {
        $this->itemNormalizer = $itemNormalizer;
    }

    /**
     * @param Contact $object
     * @param string $to
     * @param array $context
     * @return object|void
     */
    public function transform($object, string $to, array $context = [])
    {
        return ContactDto::fromContact($object);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === ContactDto::class;
    }
}
