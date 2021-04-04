<?php
/**
* This file is part of the planb project.
*
* (c) jmpantoja
<jmpantoja@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\DBAL\Type;

use App\Domain\FilmArchive\MovieId;
use Doctrine\DBAL\Types\Type;
use Tangram\Domain\Model\EntityId;
use Tangram\Infrastructure\Doctrine\DBAL\Type\EntityIdType;

final class MovieIdType extends EntityIdType {

    public static function name(): string
    {
        return 'MovieId';
    }

    public function makeFromValue(string $value): EntityId
    {
        return new MovieId($value);
    }
}
