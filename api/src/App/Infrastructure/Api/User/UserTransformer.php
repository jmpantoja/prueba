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

namespace App\Infrastructure\Api\User;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Application\User\Dto\UserDto;
use App\Domain\User\User;

final class UserTransformer implements DataTransformerInterface
{

    /**
     * @param User $object
     * @param string $to
     * @param array $context
     * @return object|void
     */
    public function transform($object, string $to, array $context = [])
    {

        $dto = new UserDto();
        $dto->id = $object->getId();
        $dto->email = $object->getEmail();
        $dto->password = null;
        $dto->roles = $object->getRoles();

        return $dto;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return UserDto::class === $to && $data instanceof User;

    }




}
