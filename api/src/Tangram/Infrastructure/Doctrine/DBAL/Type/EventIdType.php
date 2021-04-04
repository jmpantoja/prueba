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

namespace Tangram\Infrastructure\Doctrine\DBAL\Type;


use Tangram\Domain\Event\EventId;
use Tangram\Domain\Model\EntityId;

final class EventIdType extends EntityIdType
{

    public static function name(): string
    {
        return 'EventId';
    }

    public function makeFromValue(string $value): EntityId
    {
        return new EventId($value);
    }
}
