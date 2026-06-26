<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Tests\Serializer;

use PHPUnit\Framework\TestCase;
use Progrupa\Sketchup3DWarehouseBundle\Model\Binary;
use Progrupa\Sketchup3DWarehouseBundle\Model\Entity;
use Progrupa\Sketchup3DWarehouseBundle\Serializer\WarehouseSerializerFactory;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * The 3D Warehouse Java API requires camelCase keys (e.g. contentType) and rejects
 * snake_case. The bundle must own a serializer decoupled from the app's shared one,
 * which now enforces groups and a snake_case name converter. These tests pin the
 * write/read contract the bundle's Client relies on.
 */
class WarehouseSerializerTest extends TestCase
{
    private SerializerInterface $serializer;

    protected function setUp(): void
    {
        $this->serializer = WarehouseSerializerFactory::create();
    }

    /** The groups the Client passes on create/update (updateResource). */
    private const WRITE_GROUPS = ['Default', 'update'];

    public function testEntityWritePayloadIsCamelCaseWithRequiredFields(): void
    {
        $entity = new Entity();
        $entity->setType(Entity::TYPE_SKETCHUP_MODEL);
        $entity->setSource('ArchiUp.com');
        $entity->setTitle('A title');
        $entity->setDescription('A description');
        $entity->setExternalUrl('https://archiup.com/p/1');
        $entity->setTags(['tag_a']);
        $entity->setIsPrivate(true);
        $entity->setIsHidden(false);
        $entity->setAllowComments(true);

        $payload = $this->serializer->normalize($entity, 'array', [AbstractNormalizer::GROUPS => self::WRITE_GROUPS]);

        // camelCase, writable fields present
        self::assertSame('SKETCHUP_MODEL', $payload['type'] ?? null);
        self::assertSame('3dw', $payload['contentType'] ?? null, 'contentType is required by the API and must be camelCase');
        self::assertSame('A title', $payload['title'] ?? null);
        self::assertSame('A description', $payload['description'] ?? null);
        self::assertSame('https://archiup.com/p/1', $payload['externalUrl'] ?? null);
        self::assertSame(['tag_a'], $payload['tags'] ?? null);
        self::assertSame('ArchiUp.com', $payload['source'] ?? null);
        self::assertTrue($payload['isPrivate'] ?? null);

        // no snake_case leakage
        self::assertArrayNotHasKey('content_type', $payload);
        self::assertArrayNotHasKey('is_private', $payload);

        // server-managed / read-only fields must NOT be sent on write
        self::assertArrayNotHasKey('downloads', $payload);
        self::assertArrayNotHasKey('views', $payload);
        self::assertArrayNotHasKey('averageRating', $payload);
        self::assertArrayNotHasKey('resource', $payload);
        self::assertArrayNotHasKey('id', $payload);
        self::assertArrayNotHasKey('binaries', $payload);
    }

    public function testEntityIsPopulatedFromCamelCaseApiResponse(): void
    {
        $json = json_encode([
            'id' => 'abc-123',
            'title' => 'Returned title',
            'contentType' => '3dw',
            'downloads' => 42,
            'binaryNames' => ['model.skp'],
        ]);

        /** @var Entity $entity */
        $entity = $this->serializer->deserialize($json, Entity::class, 'json', [AbstractNormalizer::GROUPS => ['Default', 'get']]);

        self::assertSame('abc-123', $entity->getId());
        self::assertSame('Returned title', $entity->getTitle());
        self::assertSame(42, $entity->getDownloads());
        self::assertTrue($entity->hasBinary('model.skp'));
    }

    public function testBinaryWritePayloadUsesUpdateGroupAndExcludesFileHandle(): void
    {
        $binary = new Binary('entity-1', 'entities');
        $binary->setName('model.skp');
        $binary->setTypes('NEWMODEL');

        $payload = $this->serializer->normalize($binary, 'array', [AbstractNormalizer::GROUPS => self::WRITE_GROUPS]);

        self::assertSame('model.skp', $payload['name'] ?? null);
        self::assertSame('NEWMODEL', $payload['types'] ?? null);
        // the raw file resource handle must never be serialized into the JSON dto
        self::assertArrayNotHasKey('file', $payload);
        // 'fn' (downloadFilename) is a read-only field, not sent on write
        self::assertArrayNotHasKey('fn', $payload);
        self::assertArrayNotHasKey('downloadFilename', $payload);
    }
}
