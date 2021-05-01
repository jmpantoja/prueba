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

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use <?= $input['fullName'] ?>;
use <?= $entity['fullName'] ?>;
use <?= $repository['fullName'] ?>;

final class <?= $class_name ?> implements DataTransformerInterface {

    private ValidatorInterface $validator;
    private <?= $repository['shortName'] ?> $repository;

    public function __construct(ValidatorInterface $validator, <?= $repository['shortName'] ?> $repository)
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    /**
    * @param <?= $input['shortName']?> $input
    * @param string $to
    * @param array $context
    * @return object|void
    */
    public function transform($input, string $to, array $context = [])
    {
        $this->validator->validate($input, $context);

        $<?= $entity['varName']?> = $this->findEntity($input, $context);
        $data = (array)$input;
        unset($data['id']);

        if (null === $<?= $entity['varName']?>) {
            return new <?= $entity['shortName']?>(...$data);
        }

        $<?= $entity['varName']?>->update(...$data);
        return $<?= $entity['varName']?>;
    }

    private function findEntity(<?= $input['shortName'] ?> $input, array $context): ?<?= $entity['shortName'] ?>
    {
        $<?= $entity['varName']?> = $context[ObjectNormalizer::OBJECT_TO_POPULATE] ?? null;
        if($<?= $entity['varName']?> instanceof <?= $entity['shortName']?>){
            return $<?= $entity['varName']?>;
        }

        if(is_null($input->id)){
            return null;
        }

        return $this->repository->find($input->id);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return $to === <?= $entity['shortName']?>::class;
    }
}

<?php
    function transformer_arguments($params)  {
        $pieces = array_map(function ($param){
            return sprintf('$input->%s',  $param);
        }, array_keys($params));

        return implode(', ', $pieces);
    }
?>
