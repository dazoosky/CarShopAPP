<?php

namespace WorkshopBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testPanel()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/panel');
    }

}
