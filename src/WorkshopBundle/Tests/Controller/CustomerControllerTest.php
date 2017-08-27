<?php

namespace WorkshopBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerControllerTest extends WebTestCase
{
    public function testCustomerpanel()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/customerPanel');
    }

}
