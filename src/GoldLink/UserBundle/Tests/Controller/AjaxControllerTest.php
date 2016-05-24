<?php

namespace GoldLink\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AjaxControllerTest extends WebTestCase
{
    public function testUpdatefilactualite()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/UpdateFilActualite');
    }

}
