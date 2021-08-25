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

namespace Tangram\Infrastructure\ApiPlatform\Core\Bridge\Doctrine\Orm\Filter;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

class FullNameFilter extends TextFilter
{

    public const PARAMETER_EQUALS = 'equals';
    public const PARAMETER_CONTAINS = 'contains';
    public const PARAMETER_BEGINS = 'begins';
    public const PARAMETER_ENDS = 'ends';

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        // otherwise filter is applied to order and page as well
        if (
            !$this->isPropertyEnabled($property, $resourceClass) ||
            !$this->isPropertyMapped($property, $resourceClass)
        ) {
            return;
        }

        $alias = $queryBuilder->getRootAliases()[0];

        foreach ($value as $strategy => $token) {
            $paramName = $queryNameGenerator->generateParameterName('value');
            $queryBuilder
                ->andWhere(sprintf('%1$s.%2$s.name like :%3$s OR %1$s.%2$s.lastName like :%3$s', $alias, $property, $paramName))
                ->setParameter($paramName, $this->paramValue($strategy, $token));
        }
    }

}
