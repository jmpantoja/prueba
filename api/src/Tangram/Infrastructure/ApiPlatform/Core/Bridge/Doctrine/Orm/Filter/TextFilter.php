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


use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractContextAwareFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

class TextFilter extends AbstractContextAwareFilter
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
            $queryBuilder->andWhere(sprintf('%s.%s like :%s', $alias, $property, $paramName))
                ->setParameter($paramName, $this->paramValue($strategy, $token));
        }
    }

    protected function paramValue(string $strategy, string $token)
    {
        switch ($strategy) {
            case self::PARAMETER_EQUALS:
                return $token;
            case self::PARAMETER_CONTAINS:
                return "%$token%";
            case self::PARAMETER_BEGINS:
                return "$token%";
            case self::PARAMETER_ENDS:
                return "%$token";
        }
    }

    public function getDescription(string $resourceClass): array
    {
        if (!$this->properties) {
            return [];
        }

        $description = [];
        foreach ($this->properties as $property => $strategy) {
            if (!$this->isPropertyMapped($property, $resourceClass)) {
                continue;
            }
            $description += $this->getFilterDescription($property, self::PARAMETER_EQUALS);
            $description += $this->getFilterDescription($property, self::PARAMETER_CONTAINS);
            $description += $this->getFilterDescription($property, self::PARAMETER_BEGINS);
            $description += $this->getFilterDescription($property, self::PARAMETER_ENDS);
        }

        return $description;
    }

    /**
     * Gets filter description.
     */
    protected function getFilterDescription(string $property, string $period): array
    {
        $propertyName = $this->normalizePropertyName($property);

        return [
            sprintf('%s[%s]', $propertyName, $period) => [
                'property' => $propertyName,
                'type' => 'string',
                'required' => false,
            ],
        ];
    }

}
