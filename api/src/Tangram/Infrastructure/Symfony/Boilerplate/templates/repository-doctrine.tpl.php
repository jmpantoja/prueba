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

namespace <?= $namespace; ?>;

use <?= $entity['fullName']?>;
use <?= $entityId['fullName']?>;
use <?= $repository['fullName']?>;
use <?= $input['fullName']?>;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class <?= $class_name ?> extends ServiceEntityRepository implements <?= $repository['shortName']?>{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, <?= $entity['shortName']?>::class);
    }

    public function save(<?= $entity['shortName']?> $<?= $entity['shortName'] ?>)
    {
        $this->getEntityManager()->persist($<?= $entity['shortName'] ?>);
    }

    public function delete(<?= $entityId['shortName']?> $<?= $entityId['varName'] ?>)
    {
        $<?= $entity['varName'] ?> = $this->getEntityManager()->getReference(<?= $entity['shortName'] ?>::class, $<?= $entityId['varName'] ?>);
        $this->getEntityManager()->remove($<?= $entity['varName'] ?>);
    }

    public function findOrCreate(<?= $input['shortName']?> $input)
    {
        if (null !== $input->id) {
            return $this->find($input->id);
        }

        return new <?= $entity['shortName']?>($input);
    }
}
