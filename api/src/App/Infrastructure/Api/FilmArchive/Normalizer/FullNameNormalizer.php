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

namespace App\Infrastructure\Api\FilmArchive\Normalizer;

use App\Domain\FilmArchive\FullName;
use Negotiation\Tests\DummyAccept;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class FullNameNormalizer implements NormalizerInterface, DenormalizerInterface {
    /**
    * @param FullName $fullName    * @param string|null $format
    * @param array $context
    * @return mixed
    */
    public function normalize($fullName, string $format = null, array $context = [])
    {

        return [
            'name'=>$fullName->name(),
            'lastName'=>$fullName->lastName(),
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof FullName;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        return new FullName(...$data);
    }

    public function supportsDenormalization($data, string $type, string $format = null)
    {
        return $type === FullName::class;
    }
}
