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

namespace App\Domain\Example;


use Carbon\CarbonImmutable;

final class Contact
{
    private int $id;
    private FullName $fullName;
    private CarbonImmutable $birthDate;

    public function __construct(FullName $fullName, CarbonImmutable $birthDate)
    {
        $this->fullName = $fullName;
        $this->birthDate = $birthDate;
    }

    public function update(FullName $fullName, CarbonImmutable $birthDate): self
    {
        $this->fullName = $fullName;
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return FullName
     */
    public function fullName(): FullName
    {
        return $this->fullName;
    }

    /**
     * @return CarbonImmutable
     */
    public function birthDate(): CarbonImmutable
    {
        return $this->birthDate;
    }
}
