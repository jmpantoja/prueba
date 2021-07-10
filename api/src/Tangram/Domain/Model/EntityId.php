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

namespace Tangram\Domain\Model;


use Symfony\Component\Uid\Ulid;

class EntityId
{
    protected Ulid $ulid;

    /**
     * EntityId constructor.
     * @param Ulid|null $ulid
     */
    final public function __construct(string $ulid = null)
    {
        if (is_null($ulid)) {
            $this->ulid = new Ulid();
            return;
            }

        $this->ulid = Ulid::fromString($ulid);
    }


    /**
     * @return string
     */
    public function ulid(): Ulid
    {
        return $this->ulid;
    }

    /**
     * @param EntityId $otherId
     *
     * @return bool
     */
    public function equals(EntityId $otherId): bool
    {
        return $this->ulid()->equals($otherId->ulid());
    }


    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->ulid()->toRfc4122();
    }
}
