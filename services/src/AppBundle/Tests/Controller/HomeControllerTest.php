<?php

namespace AppBundle\Tests\Controller;

use Bazinga\Bundle\RestExtraBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\HttpFoundation\Response;

class HomeControllerTest extends WebTestCase
{

    public function testGetNote() {
		
        $client->request('GET', '/carousel/0.json');
        $response = $client->getResponse();

        $this->assertEquals(404, $response->getStatusCode(), $response->getContent());
        $this->assertEquals('{"code":404,"message":"Record does not exist."}', $response->getContent());
		
    }

}
