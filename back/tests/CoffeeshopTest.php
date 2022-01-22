<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class CoffeeshopTest extends ApiTestCase
{
    public function testSomething(): void
    {
        $response = static::createClient()->request('GET', '/api/coffeeshops');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(['@id' => '/api/coffeeshops']);

        $this->assertCount(10, $response->toArray()['hydra:member']);
    }
}
