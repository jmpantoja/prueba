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

namespace App\Application\Example\Dto;


use App\Domain\Example\FullName;

final class FullNameDto
{
    public string $firstName;
    public string $lastName;

    public static function fromFullName(FullName $fullName): FullNameDto
    {
        $dto = new self();
        $dto->firstName = $fullName->firstName();
        $dto->lastName = $fullName->lastName();

        return $dto;
    }
}
