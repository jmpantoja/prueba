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


use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Application\Greeting\Dto\GreetingDto;
use App\Domain\Greeting\Greeting;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

final class GreetingPersister implements ContextAwareDataPersisterInterface
{

    /**
     * @var EntityManager
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof GreetingDto;
    }

    public function persist($data, array $context = [])
    {
        dump([
            'Voy por aqui',
            'Ver como usar aqui un serializer para  pasar de Greeting a GreetingDto y viceversa',
            'Ver como manejar todo esto con Value Objects, mientras normalize/denormalize (Dto con un ValueObject??)',
            'Ver si los input / output son una mejor alternativa (creo que no)',
            'Casos de uso en Application (commands y queries)'
        ]);
        die();
        //el command del usecase puede ser el dto tal cual, o no

        $greeting = new Greeting($data->name);

        $this->entityManager->persist($greeting);
        $this->entityManager->flush($greeting);

        //ver como enchufar aqui el serializer para pasar de Greeting a GreetingDto y viceversa

        $data->id = $greeting->getId();
        return $data;
    }

    public function remove($data, array $context = [])
    {
        //el command del usecase puede ser el Id (GreetingId) tal cual
    }
}
