<?= "<?php\n" ?>
/**
* This file is part of the planb project.
*
* (c) jmpantoja <jmpantoja@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

declare(strict_types=1);

namespace <?= $namespace ?>;

use <?= $repository['fullName'] ?>;
use Tangram\Application\UseCase\UseCaseInterface;


final class <?= $class_name ?> implements UseCaseInterface{
    /**
    * @var <?= $repository['shortName'] ?>
    */
    private <?= $repository['shortName'] ?> $repository;

    public function __construct(<?= $repository['shortName'] ?> $repository)
    {
        $this->repository = $repository;
    }

    public function handle(<?= $deleteCommand['shortName'] ?> $command)
    {
        $this->repository->delete($command-><?= $entityId['varName'] ?>());
    }
}
