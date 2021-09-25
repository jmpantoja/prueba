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

namespace Tangram\Infrastructure\Scaffold\Resource;

use Tangram\Domain\Lists\TypedList;
use Tangram\Infrastructure\Scaffold\Model\Model;
use Tangram\Infrastructure\Scaffold\Resource\Entity\ApiMapping;
use Tangram\Infrastructure\Scaffold\Resource\Entity\CreateEvent;
use Tangram\Infrastructure\Scaffold\Resource\Entity\DbalTypes;
use Tangram\Infrastructure\Scaffold\Resource\Entity\DeleteCommand;
use Tangram\Infrastructure\Scaffold\Resource\Entity\DeleteEvent;
use Tangram\Infrastructure\Scaffold\Resource\Entity\DeleteUseCase;
use Tangram\Infrastructure\Scaffold\Resource\Entity\DoctrineMapping;
use Tangram\Infrastructure\Scaffold\Resource\Entity\EntityClass;
use Tangram\Infrastructure\Scaffold\Resource\Entity\EntityId;
use Tangram\Infrastructure\Scaffold\Resource\Entity\EntityIdType;
use Tangram\Infrastructure\Scaffold\Resource\Entity\EntityList;
use Tangram\Infrastructure\Scaffold\Resource\Entity\EntityTrait;
use Tangram\Infrastructure\Scaffold\Resource\Entity\Fixtures;
use Tangram\Infrastructure\Scaffold\Resource\Entity\Input;
use Tangram\Infrastructure\Scaffold\Resource\Entity\InputTransformer;
use Tangram\Infrastructure\Scaffold\Resource\Entity\OrderFilterConfig;
use Tangram\Infrastructure\Scaffold\Resource\Entity\Output;
use Tangram\Infrastructure\Scaffold\Resource\Entity\OutputTransformer;
use Tangram\Infrastructure\Scaffold\Resource\Entity\Persister;
use Tangram\Infrastructure\Scaffold\Resource\Entity\Repository;
use Tangram\Infrastructure\Scaffold\Resource\Entity\RepositoryDoctrine;
use Tangram\Infrastructure\Scaffold\Resource\Entity\SaveCommand;
use Tangram\Infrastructure\Scaffold\Resource\Entity\SaveUseCase;
use Tangram\Infrastructure\Scaffold\Resource\Entity\SearchFilterConfig;
use Tangram\Infrastructure\Scaffold\Resource\Entity\SerializeMapping;
use Tangram\Infrastructure\Scaffold\Resource\Entity\Test;
use Tangram\Infrastructure\Scaffold\Resource\Entity\UpdateEvent;
use Tangram\Infrastructure\Scaffold\Resource\Entity\Validation;
use Tangram\Infrastructure\Scaffold\Resource\Enum\Enum;
use Tangram\Infrastructure\Scaffold\Resource\Enum\EnumNormalizer;
use Tangram\Infrastructure\Scaffold\Resource\Enum\EnumTest;
use Tangram\Infrastructure\Scaffold\Resource\Enum\EnumType;
use Tangram\Infrastructure\Scaffold\Resource\VO\Constraint;
use Tangram\Infrastructure\Scaffold\Resource\VO\EmbeddableMapping;
use Tangram\Infrastructure\Scaffold\Resource\VO\Normalizer;
use Tangram\Infrastructure\Scaffold\Resource\VO\VO;
use Tangram\Infrastructure\Scaffold\Resource\VO\VOTest;
use Tangram\Infrastructure\Scaffold\Resource\VO\VOType;

final class ResourceList extends TypedList
{
	public function type(): string
	{
		return Resource::class;
	}

	public static function create(): self
	{
		$input = [
			'entity' => new EntityClass(),
			'entityTrait' => new EntityTrait(),
			'entityList' => new EntityList(),
			'entityId' => new EntityId(),
			'entityIdType' => new EntityIdType(),
			'repository' => new Repository(),
			'repositoryDoctrine' => new RepositoryDoctrine(),
			'input' => new Input(),
			'inputTransformer' => new InputTransformer(),
			'output' => new Output(),
			'outputTransformer' => new OutputTransformer(),
			'orderFilter' => new OrderFilterConfig(),
			'searchFilter' => new SearchFilterConfig(),

			'createEvent' => new CreateEvent(),
			'deleteEvent' => new DeleteEvent(),
			'updateEvent' => new UpdateEvent(),
			'saveCommand' => new SaveCommand(),
			'saveUseCase' => new SaveUseCase(),
			'deleteCommand' => new DeleteCommand(),
			'deleteUseCase' => new DeleteUseCase(),
			'persister' => new Persister(),
			'fixtures' => new Fixtures(),
			'test' => new Test(),

			'apiMapping' => new ApiMapping(),
			'doctrineMapping' => new DoctrineMapping(),
			'serializeMapping' => new SerializeMapping(),
			'validation' => new Validation(),
			'dbalTypes' => new DbalTypes(),

			'valueObject' => new VO(),
			'valueObjectType' => new VOType(),
			'embeddable' => new EmbeddableMapping(),
			'valueObjectTest' => new VOTest(),
			'normalizer' => new Normalizer(),
			'constraint' => new Constraint(),

			'enum' => new Enum(),
			'enumType' => new EnumType(),
			'enumNormalizer' => new EnumNormalizer(),
			'enumTest' => new EnumTest(),
		];

		return new self($input);
	}

	public function supportedBy(Model $definition)
	{
		return $this->filter(fn (Resource $resource) => $resource->supports($definition));
	}
}
