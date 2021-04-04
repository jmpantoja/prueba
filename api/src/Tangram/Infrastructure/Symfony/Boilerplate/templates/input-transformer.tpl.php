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
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use <?= $input['fullName'] ?>;
use <?= $entity['fullName'] ?>;

final class <?= $class_name ?> implements DataTransformerInterface {


    /**
    * @param <?= $input['shortName']?> $<?= $input['varName'] . "\n"?>
    * @param string $to
    * @param array $context
    * @return object|void
    */
    public function transform($input, string $to, array $context = [])
    {
        /** @var <?= $entity['shortName']?> $<?= $entity['varName']?> */
        $<?= $entity['varName']?> = $context[ObjectNormalizer::OBJECT_TO_POPULATE] ?? null;
        $data = (array)$input;

        if (null === $<?= $entity['varName']?>) {
            return new <?= $entity['shortName']?>(...$data);
        }

        $<?= $entity['varName']?>->update(...$data);
        return $<?= $entity['varName']?>;
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
