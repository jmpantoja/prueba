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

use <?= $entity['fullName'] ?>;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class <?= $class_name ?> implements NormalizerInterface, DenormalizerInterface {
    /**
    * @param <?=$entity['shortName']?> $<?=$entity['varName']?>
    * @param string|null $format
    * @param array $context
    * @return mixed
    */
    public function normalize($<?=$entity['varName']?>, string $format = null, array $context = [])
    {
        //Delete this method for typeLists
        $message = sprintf('Incomplete method "%s"', __METHOD__);
        throw new Exception($message);
    }

    public function supportsNormalization($data, string $format = null)
    {
        //Delete this method for typeLists
        return $data instanceof <?=$entity['shortName']?>;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $message = sprintf('Incomplete method "%s"', __METHOD__);
        throw new Exception($message);
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return $type === <?=$entity['shortName']?>::class;
    }
}
