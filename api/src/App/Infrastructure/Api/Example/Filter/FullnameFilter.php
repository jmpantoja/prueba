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

namespace App\Infrastructure\Api\Example\Filter;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use Tangram\ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\TextFilter;

final class FullnameFilter extends TextFilter
{
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

            $firstName = sprintf('%s.%s.firstName like :%s', $alias, $property, $paramName);
            $lastName = sprintf('%s.%s.lastName like :%s', $alias, $property, $paramName);

            $queryBuilder
                ->andWhere("$firstName OR $lastName")
                ->setParameter($paramName, $this->paramValue($strategy, $token));
        }

//        print_r($property);
//        print_r($value);
//        die();
    }
}
