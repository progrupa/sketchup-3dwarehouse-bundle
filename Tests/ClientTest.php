<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Tests;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Progrupa\Sketchup3DWarehouseBundle\ApiResponse;
use Progrupa\Sketchup3DWarehouseBundle\Client;
use Progrupa\Sketchup3DWarehouseBundle\Model\Binary;
use Progrupa\Sketchup3DWarehouseBundle\Model\Entity;
use Progrupa\Sketchup3DWarehouseBundle\Search\Query;
use Progrupa\Sketchup3DWarehouseBundle\Search\Result;
use Progrupa\Sketchup3DWarehouseBundle\Serializer\WarehouseSerializerFactory;

/**
 * Exercises the real Client request-building and response-handling against a mocked
 * transport, with the bundle's dedicated serializer. Guards the contract that broke
 * when the app's shared serializer started enforcing groups + snake_case.
 */
class ClientTest extends TestCase
{
    /** @var array<int, array{request: \Psr\Http\Message\RequestInterface}> */
    private array $history = [];

    private function client(array $responses): Client
    {
        $stack = HandlerStack::create(new MockHandler($responses));
        $stack->push(Middleware::history($this->history));
        $guzzle = new Guzzle([
            'handler' => $stack,
            'base_uri' => 'https://example.test/warehouse/v1.0/',
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        return new Client($guzzle, WarehouseSerializerFactory::create(), 'auth-id', 'secret');
    }

    public function testNewEntityIsCreatedWithCamelCaseJsonBody(): void
    {
        $client = $this->client([
            new Response(201, ['Location' => 'https://example.test/warehouse/v1.0/entities/new-id']),
            new Response(200, [], json_encode(['id' => 'new-id', 'title' => 'T', 'contentType' => '3dw'])),
        ]);

        $entity = new Entity();
        $entity->setType(Entity::TYPE_SKETCHUP_MODEL);
        $entity->setTitle('T');
        $entity->setIsPrivate(true);

        $resp = $client->updateResource($entity);

        self::assertTrue($resp->isSuccess());
        self::assertInstanceOf(Entity::class, $resp->getEntity());
        self::assertSame('new-id', $resp->getEntity()->getId());

        $postRequest = $this->history[0]['request'];
        self::assertSame('POST', $postRequest->getMethod());
        self::assertStringEndsWith('/entities', (string) $postRequest->getUri());
        $body = json_decode((string) $postRequest->getBody(), true);
        self::assertSame('3dw', $body['contentType'], 'API requires camelCase contentType');
        self::assertSame('SKETCHUP_MODEL', $body['type']);
        self::assertArrayNotHasKey('content_type', $body);
        self::assertArrayNotHasKey('id', $body, 'id is server-assigned and must not be sent');
        // Authorization header is applied
        self::assertStringStartsWith('3DWCustomKey ', $postRequest->getHeaderLine('Authorization'));
    }

    public function testExistingEntityIsPatchedAtItsIdUrl(): void
    {
        $client = $this->client([new Response(204)]);

        $entity = new Entity('existing-id');
        $entity->setTitle('Updated');

        $resp = $client->updateResource($entity);

        self::assertTrue($resp->isSuccess());
        $request = $this->history[0]['request'];
        self::assertSame('PATCH', $request->getMethod(), 'an entity with an id must PATCH, not POST');
        self::assertStringEndsWith('/entities/existing-id', (string) $request->getUri());
        $body = json_decode((string) $request->getBody(), true);
        self::assertSame('Updated', $body['title']);
    }

    public function testErrorResponseIsReturnedAsApiResponseWithoutThrowing(): void
    {
        $client = $this->client([
            new Response(400, [], json_encode(['message' => "Parameter 'contentType' must not be empty or null.", 'errorId' => 'PARAM_MUST_NOT_BE_EMPTY'])),
        ]);

        $resp = $client->updateResource(new Entity());

        self::assertInstanceOf(ApiResponse::class, $resp);
        self::assertFalse($resp->isSuccess());
        self::assertSame("Parameter 'contentType' must not be empty or null.", $resp->getMessage());
        self::assertSame('PARAM_MUST_NOT_BE_EMPTY', $resp->getErrorId());
    }

    public function testErrorResponseWithNonJsonBodyIsReturnedAsFailureWithoutThrowing(): void
    {
        // 3DW occasionally answers an error status with a non-JSON body: an HTML
        // gateway page from a 502/503, an auth challenge, a rate-limit notice. The
        // Client must surface that as a failed ApiResponse, not let the JSON decode
        // error (NotEncodableValueException) escape and abort the whole export.
        $client = $this->client([
            new Response(502, [], '<html><head><title>502 Bad Gateway</title></head><body>nginx</body></html>'),
        ]);

        $resp = $client->updateResource(new Entity('existing-id'));

        self::assertInstanceOf(ApiResponse::class, $resp);
        self::assertFalse($resp->isSuccess());
        self::assertSame(502, $resp->getCode());
    }

    public function testEmptyErrorBodyIsReturnedAsFailureWithoutThrowing(): void
    {
        $client = $this->client([
            new Response(503, [], ''),
        ]);

        $resp = $client->updateResource(new Entity('existing-id'));

        self::assertInstanceOf(ApiResponse::class, $resp);
        self::assertFalse($resp->isSuccess());
        self::assertSame(503, $resp->getCode());
    }

    public function testSearchWithNonJsonBodyIsReturnedAsUnsuccessfulResultWithoutThrowing(): void
    {
        // A response carrying a non-JSON body (an HTML interstitial, a maintenance
        // page) must not crash the search; it is reported as an unsuccessful Result.
        $client = $this->client([
            new Response(200, [], '<html><body>under maintenance</body></html>'),
        ]);

        $query = new Query();
        $query->setClass(Query::CLASS_ENTITY);

        $result = $client->search($query);

        self::assertInstanceOf(Result::class, $result);
        self::assertFalse($result->isSuccess());
    }

    public function testCreatePreservesSuccessWhenReadBackIsNotYetConsistent(): void
    {
        // POST succeeds (201 Created) but the immediate read-back of the new
        // Location 404s because 3DW has not made the entity readable yet
        // (eventual consistency). The create must still be reported as a success
        // and expose the new id parsed from the Location header.
        $client = $this->client([
            new Response(201, ['Location' => 'https://example.test/warehouse/v1.0/entities/new-id']),
            new Response(404, [], json_encode(['message' => "Entity with id 'new-id' does not exist", 'errorId' => 'NOT_FOUND'])),
        ]);

        $resp = $client->updateResource(new Entity());

        self::assertTrue($resp->isSuccess(), 'a 201-created entity must remain a success even if the read-back 404s');
        self::assertInstanceOf(Entity::class, $resp->getEntity());
        self::assertSame('new-id', $resp->getEntity()->getId());
    }

    public function testBinaryUploadSendsMultipartWithDtoAndFile(): void
    {
        $client = $this->client([
            new Response(201, ['Location' => 'https://example.test/warehouse/v1.0/entities/e1/binaries/model.skp']),
            new Response(200, [], json_encode(['fn' => 'model.skp'])),
        ]);

        $tmp = tempnam(sys_get_temp_dir(), 'bin_') . '.skp';
        file_put_contents($tmp, 'DUMMY');
        $binary = Binary::fromObject(new Entity('e1'));
        $binary->setName('model.skp');
        $binary->setFile($tmp);

        $resp = $client->updateResource($binary);
        self::assertTrue($resp->isSuccess());

        $request = $this->history[0]['request'];
        self::assertSame('POST', $request->getMethod());
        self::assertStringEndsWith('/entities/e1/binaries', (string) $request->getUri());
        self::assertStringContainsString('multipart/form-data', $request->getHeaderLine('Content-Type'));
        $raw = (string) $request->getBody();
        self::assertStringContainsString('name="dto"', $raw);
        self::assertStringContainsString('name="file"', $raw);
        self::assertStringContainsString('"name":"model.skp"', $raw);
        @unlink($tmp);
    }
}
