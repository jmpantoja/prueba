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

namespace Tangram\Infrastructure\Api\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Common\Filter\OrderFilterTrait;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractOrderFilter extends OrderFilter
{
	use OrderFilterTrait;

	/**
	 * {@inheritdoc}
	 */
	protected function filterProperty(string $property, $direction, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
	{
		if (!$this->isPropertyEnabled($property, $resourceClass) || !$this->isPropertyMapped($property, $resourceClass)) {
			return;
		}

		$direction = $this->normalizeValue($direction, $property);
		if (null === $direction) {
			return;
		}

		$alias = $queryBuilder->getRootAliases()[0];
		$field = $property;

		if ($this->isPropertyNested($property, $resourceClass)) {
			[$alias, $field] = $this->addJoinsForNestedProperty($property, $alias, $queryBuilder, $queryNameGenerator, $resourceClass, Join::LEFT_JOIN);
		}

		if (null !== $nullsComparison = $this->properties[$property]['nulls_comparison'] ?? null) {
			$nullsDirection = self::NULLS_DIRECTION_MAP[$nullsComparison][$direction];

			$nullRankHiddenField = sprintf('_%s_%s_null_rank', $alias, $field);

			$queryBuilder->addSelect(sprintf('CASE WHEN %s.%s IS NULL THEN 0 ELSE 1 END AS HIDDEN %s', $alias, $field, $nullRankHiddenField));
			$queryBuilder->addOrderBy($nullRankHiddenField, $nullsDirection);
		}

		$clause = $this->formatOrderClause($alias, $field);
		$queryBuilder->addOrderBy($clause, $direction);
	}

	abstract protected function formatOrderClause(string $alias, string $field): string;
}
