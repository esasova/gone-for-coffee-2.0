<?php

namespace App\Tests;

use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadImageTest extends WebTestCase
{
    use RefreshDatabaseTrait;

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     */
    public function testUploadImage(): void
    {
        $client = static::createClient();
        $filePathFrom = __DIR__.'/../fixtures/dog.jpg';
        $filePathTo = __DIR__.'/../fixtures/dog_test.jpg';
        copy($filePathFrom, $filePathTo);

        $uploadedFile = new UploadedFile(
            $filePathTo,
            'dog.jpg',
            null,
            null,
            true
        );

        $client->request('POST', '/api/coffeeshop/1/images', [],
            [
                'image' => $uploadedFile,
            ]
        );

        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString(
            '{"coffeeshop_id":1,"path":',
            $client->getResponse()->getContent()
        );
    }
}
