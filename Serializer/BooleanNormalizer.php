<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Serializer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Custom normalizer for handling Su3DWBoolean type (string 'true'/'false' to boolean)
 */
class BooleanNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize(mixed $object, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        if ($object === null) {
            return null;
        }
        return $object ? 'true' : 'false';
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return is_bool($data) && isset($context['su3dw_boolean']) && $context['su3dw_boolean'] === true;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        if ($data === null || $data === '') {
            return null;
        }
        return strtolower($data) === 'true';
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return isset($context['su3dw_boolean']) && $context['su3dw_boolean'] === true;
    }
}
