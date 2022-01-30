<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\BaseDatabaseTrait;

class CoffeeshopTest extends ApiTestCase
{
    use BaseDatabaseTrait;
    public $client;

    public function setUp(): void
    {
        $this->client = self::createClient();
        static::populateDatabase();
    }

    public function testGetAllCoffeeshops(): void
    {
        $response = $this->client->request(
            'GET',
            '/api/coffeeshops.json',
            [
                'headers' => ['accept' => ['application/json']],
            ]
        );

        $this->assertResponseHeaderSame('content-type', 'application/json; charset=utf-8');
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(
            [
                [
                    'id' => 1,
                    'name' => 'Mokxa Coffee',
                    'address' => '1 rue Jubin',
                    'city' => 'Villeurbanne',
                    'postcode' => '69100',
                    'coordinates' => [
                        '45.7712128',
                        '4.8648653',
                    ],
                ],
            ],
        );
        $this->assertCount(10, $response->toArray());
    }

    public function testPostCoffeeshop(): void
    {
        $response = $this->client->request(
            'POST',
            '/api/coffeeshops',
             [
                'headers' => ['accept' => ['application/json']],
                'json' => [
                    'name' => 'Mokxa Coffee 2',
                    'address' => '2 rue Jubin',
                    'city' => 'Villeurbanne',
                    'postcode' => '69100',
                    'description' => 'Mokxa Coffee est bien',
                    'timetable' => [
                        [
                            'day' => '/api/days/1',
                            'start' => '2022-01-30T09:10:20+01:00',
                            'end' => '2022-01-30T18:10:20+01:00',
                        ],
                        [
                            'day' => '/api/days/2',
                            'start' => '2022-01-30T09:10:20+01:00',
                            'end' => '2022-01-30T18:20:00+01:00',
                        ],
                    ],
                ],
            ]
        );

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(
            [
                'name' => 'Mokxa Coffee 2',
                'address' => '2 rue Jubin',
                'city' => 'Villeurbanne',
                'postcode' => '69100',
                'description' => 'Mokxa Coffee est bien',
                'timetable' => [
                    [
                        'day' => [
                            'id' => 1,
                            'name' => 'lundi',
                        ],
                        'start' => '2022-01-30T09:10:20+01:00',
                        'end' => '2022-01-30T18:10:20+01:00',
                    ],
                    [
                        'day' => [
                            'id' => 2,
                            'name' => 'mardi',
                        ],
                        'start' => '2022-01-30T09:10:20+01:00',
                        'end' => '2022-01-30T18:20:00+01:00',
                    ],
                ],
            ]
        );

        $response = $this->client->request(
            'GET',
            '/api/coffeeshops.json',
            [
                'headers' => ['accept' => ['application/json']],
            ]
        );

        $this->assertCount(11, $response->toArray());
    }

    public function testPutCoffeeshop(): void
    {
        $this->client->request(
            'PUT',
            '/api/coffeeshops/1',
            [
                'headers' => ['accept' => ['application/json']],
                'json' => [
                    'name' => 'Mokxa Coffee 3',
                    'address' => '3 rue Jubin',
                ],
            ]
        );

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(
            [
                'name' => 'Mokxa Coffee 3',
                'address' => '3 rue Jubin',
                'city' => 'Villeurbanne',
                'postcode' => '69100',
                'description' => 'best coffee shop ever !',
            ],
        );

        $this->client->request(
            'GET',
            '/api/coffeeshops/1',
            [
                'headers' => ['accept' => ['application/json']],
            ]
        );

        $this->assertJsonContains(
            [
                'name' => 'Mokxa Coffee 3',
                'address' => '3 rue Jubin',
                'city' => 'Villeurbanne',
                'postcode' => '69100',
                'description' => 'best coffee shop ever !',
            ],
        );
    }

    public function testDeleteCoffeeshop(): void
    {
        $this->client->request(
            'DELETE',
            '/api/coffeeshops/1',
            []
        );
        $this->assertResponseIsSuccessful();
    }
}
