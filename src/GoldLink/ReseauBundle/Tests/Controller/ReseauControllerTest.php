<?php

namespace GoldLink\ReseauBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReseauControllerTest extends WebTestCase
{
    public function testGroupe()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/groupe');
    }

}
