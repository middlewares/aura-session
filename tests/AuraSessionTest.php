<?php

namespace Middlewares\Tests;

use PHPUnit\Framework\TestCase;
use Middlewares\AuraSession;
use Middlewares\Utils\Dispatcher;
use Middlewares\Utils\Factory;

class AuraSessionTest extends TestCase
{
    public function testAuraSession()
    {
        $request = Factory::createServerRequest();

        $response = (new Dispatcher([
            (new AuraSession())->name('custom-session'),
            function ($request) {
                $session = $request->getAttribute('session');
                $this->assertInstanceOf('Aura\\Session\\Session', $session);

                $response = Factory::createResponse();
                $response->getBody()->write($session->getName());

                return $response;
            },
        ]))->dispatch($request);

        $this->assertInstanceOf('Psr\\Http\\Message\\ResponseInterface', $response);
        $this->assertEquals('custom-session', (string) $response->getBody());
    }
}