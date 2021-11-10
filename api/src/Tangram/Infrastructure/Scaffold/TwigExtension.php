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

namespace Tangram\Infrastructure\Scaffold;

use Exception;
use MyCLabs\Enum\Enum;
use function Symfony\Component\String\u;
use Tangram\Infrastructure\Scaffold\Model\Attribute;
use Tangram\Infrastructure\Scaffold\Model\Reference;
use Tangram\Infrastructure\Scaffold\Model\Relation;
use Tangram\Infrastructure\Scaffold\Resolver\Target;
use Twig\Extension\AbstractExtension;
use Twig\Markup;
use Twig\TwigFilter;

final class TwigExtension extends AbstractExtension
{
	private array $context;

	public function __construct(array $context = [])
	{
		$this->context = $context;
	}

	public function getFilters()
	{
		return [
			new TwigFilter('add_quotes', [$this, 'addQuotes'], ['is_safe' => ['html']]),
			new TwigFilter('ref', [$this, 'reference'], ['is_safe' => ['html']]),
			new TwigFilter('short_name', [$this, 'shortName'], ['is_safe' => ['html']]),
			new TwigFilter('full_name', [$this, 'fullName'], ['is_safe' => ['html']]),
			new TwigFilter('type_name', [$this, 'typeName'], ['is_safe' => ['html']]),
			new TwigFilter('table_name', [$this, 'tableName'], ['is_safe' => ['html']]),
			new TwigFilter('dbal_type', [$this, 'dbalType'], ['is_safe' => ['html']]),
			new TwigFilter('type_full_name', [$this, 'typeFullName'], ['is_safe' => ['html']]),
			new TwigFilter('arg_type', [$this, 'argType'], ['is_safe' => ['html']]),
			new TwigFilter('var_name', [$this, 'varName'], ['is_safe' => ['html']]),
			new TwigFilter('key_name', [$this, 'keyName'], ['is_safe' => ['html']]),
			new TwigFilter('single_var_name', [$this, 'singleVarName'], ['is_safe' => ['html']]),
			new TwigFilter('single_key_name', [$this, 'singleKeyName'], ['is_safe' => ['html']]),
			new TwigFilter('list_name', [$this, 'listName'], ['is_safe' => ['html']]),
			new TwigFilter('list_full_name', [$this, 'listFullName'], ['is_safe' => ['html']]),
			new TwigFilter('input_name', [$this, 'inputName'], ['is_safe' => ['html']]),
			new TwigFilter('input_full_name', [$this, 'inputFullName'], ['is_safe' => ['html']]),
			new TwigFilter('setter', [$this, 'setter'], ['is_safe' => ['html']]),
			new TwigFilter('adder', [$this, 'adder'], ['is_safe' => ['html']]),
			new TwigFilter('remover', [$this, 'remover'], ['is_safe' => ['html']]),
			new TwigFilter('mapping_field', [$this, 'mappingField'], ['is_safe' => ['html']]),
			new TwigFilter('filters', [$this, 'filters'], ['is_safe' => ['html']]),
			new TwigFilter('write_group', [$this, 'writeGroup'], ['is_safe' => ['html']]),
			new TwigFilter('read_group', [$this, 'readGroup'], ['is_safe' => ['html']]),
			new TwigFilter('uses', [$this, 'uses'], ['is_safe' => ['html']]),
			new TwigFilter('role_create', [$this, 'roleCreate'], ['is_safe' => ['html']]),
			new TwigFilter('role_read', [$this, 'roleRead'], ['is_safe' => ['html']]),
			new TwigFilter('role_update', [$this, 'roleUpdate'], ['is_safe' => ['html']]),
			new TwigFilter('role_delete', [$this, 'roleDelete'], ['is_safe' => ['html']]),
		];
	}

	public function reference(Reference $reference): Target
	{
		$key = $reference->key();
		if ($reference->isBuiltin()) {
			return Target::builtin($key);
		}

		if (!isset($this->context[$key])) {
			$message = sprintf('La referencia "%s" no existe', $reference->prettyKey());
			throw new Exception($message);
		}

		if ($reference->isToMany()) {
			return Target::collection($this->context[$key]);
		}

		return $this->context[$key];
	}

	public function addQuotes($value): string
	{
		if (is_string($value) || $value instanceof Markup) {
			return sprintf("'%s'", $value);
		}

		return $value;
	}

	public function typeName(Attribute|Target $target): string
	{
		if ($target instanceof Attribute) {
			$target = $this->reference($target->type());
		}

		return $target->typeName();
	}

	public function tableName(Attribute|Target $target): string
	{
		if ($target instanceof Attribute) {
			$target = $this->reference($target->type());
		}

		return u($target->shortName())->snake()->toString();
	}

	public function dbalType(Attribute|Target $target): string
	{
		if ($target instanceof Attribute) {
			$target = $this->reference($target->type());
		}

		$short = $target->shortName();

		$short = preg_replace('/(DBALType)$/', '', $short);

		return match ($short) {
			'int' => 'integer',
			default => $short
		};
	}

	public function typeFullName(Attribute|Target $target): string
	{
		if ($target instanceof Attribute) {
			$target = $this->reference($target->type());
		}

		return $target->typeFullName();
	}

	public function argType(Attribute|Target $target): string
	{
		if ($target instanceof Attribute) {
			$target = $this->reference($target->type());
		}

		return $target->argumentName();
	}

	public function varName(Attribute|Target $target): string
	{
		return sprintf('$%s', $this->keyName($target));
	}

	public function keyName(Attribute|Target $target): string
	{
		return lcfirst($target->name());
	}

	public function singleKeyName(Relation $relation): string
	{
		return lcfirst($relation->singular());
	}

	public function singleVarName(Relation $relation): string
	{
		return sprintf('$%s', $this->singleKeyName($relation));
	}

	public function shortName(Attribute|Target $target): string
	{
		if ($target instanceof Attribute) {
			$target = $this->reference($target->type());
		}

		return $target->shortName();
	}

	public function fullName(Attribute|Target $target): ?string
	{
		if ($target instanceof Attribute) {
			$target = $this->reference($target->type());
		}

		return $target->fullName();
	}

	public function listName(Attribute|Target $target): string
	{
		if ($target instanceof Attribute) {
			$target = $this->reference($target->type());
		}

		return sprintf('%sList', $target->shortName());
	}

	public function listFullName(Attribute|Target $target): string
	{
		if ($target instanceof Attribute) {
			$target = $this->reference($target->type());
		}

		return sprintf('%sList', $target->fullName());
	}

	public function inputName(Attribute|Target $target): string
	{
		if ($target instanceof Attribute) {
			$target = $this->reference($target->type());
		}

		return sprintf('%sInput', $target->shortName());
	}

	public function inputFullName(Attribute|Target $target): string
	{
		if ($target instanceof Attribute) {
			$target = $this->reference($target->type());
		}

		return sprintf('%sInput', $target->fullName());
	}

	public function setter(Attribute $attribute): string
	{
		return sprintf('put%s', ucfirst($attribute->name()));
	}

	public function adder(Relation $relation): string
	{
		return sprintf('add%s', ucfirst($relation->singular()));
	}

	public function remover(Relation $relation): string
	{
		return sprintf('remove%s', ucfirst($relation->singular()));
	}

	public function mappingField(Relation $relation): ?string
	{
		return $relation->mappingField();
	}

	public function filters(Target $target): array
	{
		$filters = [];
		foreach ($target->attributes() as $attribute) {
			$resolved = $this->reference($attribute->type());
			$type = $resolved->toSingleScalar();

			if ('string' === $type || is_subclass_of($resolved->fullName(), Enum::class)) {
				$filters['text_filter'] = $filters['text_filter'] ?? [
						'parent' => 'TextFilter',
						'args' => [],
					];

				$filters['text_filter']['args'][$attribute->name()] = null;
			}
		}

		return array_filter(array_unique($filters));
	}

	public function writeGroup(Target $target): string
	{
		return sprintf("'%s:write'", $this->tableName($target));
	}

	public function readGroup(Target $target): string
	{
		return sprintf("'%s:read'", $this->tableName($target));
	}

	public function uses(Target $target): array
	{
		foreach ($target->attributes() as $attribute) {
			$reference = $this->reference($attribute->type());
			$key = $attribute->type()->key();
			$uses[$key] = $reference;
			if ($attribute instanceof Relation and $attribute->isAggregate()) {
				$aggregate = $this->reference($attribute->type());
				$uses = array_merge($uses, $this->uses($aggregate));
			}
		}

		return array_filter($uses, function (Target $use) use ($target) {
			return $target->fullName() !== $use->fullName();
		});
	}

	public function roleCreate(Target $target): string
	{
		return sprintf('ROLE_%s_CREATE', strtoupper($this->tableName($target)));
	}

	public function roleRead(Target $target): string
	{
		return sprintf('ROLE_%s_READ', strtoupper($this->tableName($target)));
	}

	public function roleUpdate(Target $target): string
	{
		return sprintf('ROLE_%s_UPDATE', strtoupper($this->tableName($target)));
	}

	public function roleDelete(Target $target): string
	{
		return sprintf('ROLE_%s_DELETE', strtoupper($this->tableName($target)));
	}
}
