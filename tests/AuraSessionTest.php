<?php

namespace Middlewares\Tests;

use Middlewares\AuraSession;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Response;
use mindplay\middleman\Dispatcher;

class AuraSessionTest extends \PHPUnit_Framework_TestCase
{
    public function testAuraSession()
    {
        $response = (new Dispatcher([
            (new AuraSession())->name('custom-session'),
            function ($request) {
                $session = $request->getAttribute('session');
                $this->assertInstanceOf('Aura\\Session\\Session', $session);

                $response = new Response();
                $response->getBody()->write($session->getName());
                return $response;
            },
        ]))->dispatch(new ServerRequest());

        $this->assertInstanceOf('Psr\\Http\\Message\\ResponseInterface', $response);
        $this->assertEquals('custom-session', (string) $response->getBody());
    }
}
