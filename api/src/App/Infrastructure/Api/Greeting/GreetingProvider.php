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

namespace App\Infrastructure\Api\Greeting;


use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Application\Greeting\Dto\GreetingDto;
use App\Domain\Greeting\Greeting;
use Doctrine\ORM\EntityManagerInterface;

final class GreetingProvider implements ContextAwareCollectionDataProviderInterface, ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === GreetingDto::class;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $greetings = $this->entityManager->getRepository(Greeting::class)->findAll();

        return array_map(function (Greeting $greeting){
            $dto = new GreetingDto();
            $dto->id = $greeting->getId();
            $dto->name = $greeting->getName();
            return $dto;

        }, $greetings);
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        // TODO: Implement getItem() method.
    }


}
