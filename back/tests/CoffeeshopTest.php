<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Coffeeshop;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class CoffeeshopTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/api/coffeeshops');
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
                        '@context' => '/api/contexts/Coffeeshop',
                        '@id' => '/api/coffeeshops',
                        '@type' => 'hydra:Collection',
                        'hydra:totalItems' => 10,
                    ]);
        $this->assertCount(10, $response->toArray()['hydra:member']);
        $this->assertMatchesResourceCollectionJsonSchema(Coffeeshop::class);
    }
}
