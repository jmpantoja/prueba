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


use App\Domain\Example\Contact;
use App\Domain\Example\FullName;
use Carbon\CarbonImmutable;

final class ContactDto
{
    public ?int $id = null;

    public FullName $fullName;

    public CarbonImmutable $birthDate;

    public static function fromContact(Contact $contact): self
    {
        $dto = new ContactDto();
        $dto->id = $contact->id();
        $dto->fullName = $contact->fullName();
        $dto->birthDate = $contact->birthDate();

        return $dto;
    }

    public function getAge(): int
    {
        return $this->birthDate->age;
    }

}
