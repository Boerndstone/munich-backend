<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StaticPagesControllerTest extends WebTestCase
{
    public function testDatenschutzPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/Datenschutz');

        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Datenschutzerklärung');

        $this->assertSelectorExists('div.card-body');
    }
}
