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

namespace Tangram\Infrastructure\Api\Normalizer;

use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\JsonLd\Serializer\ItemNormalizer;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;

final class EntityDenormalizer extends AbstractItemNormalizer
{
	private $itemNormalizer;

	public function __construct(ItemNormalizer $itemNormalizer, IriConverterInterface $iriConverter)
	{
		$this->itemNormalizer = $itemNormalizer;
		$this->iriConverter = $iriConverter;
	}

	public function supportsNormalization($data, $format = null)
	{
		return false;
	}

	public function denormalize($data, $class, $format = null, array $context = [])
	{
		if (isset($data['@id']) && !isset($context[self::OBJECT_TO_POPULATE])) {
			if (!isset($context['resource_class'])) {
				$context['api_allow_update'] = true;
			}

			if (true !== ($context['api_allow_update'] ?? true)) {
				throw new NotNormalizableValueException('Update is not allowed for this operation.');
			}

			return $this->iriConverter->getItemFromIri($data['@id'], $context + ['fetch_data' => true]);
		}

		return $this->itemNormalizer->denormalize($data, $class, $format, $context);
	}

	public function supportsDenormalization($data, $type, $format = null): bool
	{
		return $this->itemNormalizer->supportsDenormalization($data, $type, $format);
	}
}
