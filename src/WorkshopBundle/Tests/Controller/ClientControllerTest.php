<?php

namespace WorkshopBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClientControllerTest extends WebTestCase
{
    public function testUserpanel()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/userPanel');
    }

}
