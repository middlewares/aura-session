<?php
declare(strict_types = 1);

namespace Middlewares\Tests;

use Aura\Session\Session;
use Middlewares\AuraSession;
use Middlewares\Utils\Dispatcher;
use PHPUnit\Framework\TestCase;

class AuraSessionTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testAuraSession()
    {
        $response = Dispatcher::run(
            [
                (new AuraSession())->name('custom-session'),

                function ($request) {
                    $session = $request->getAttribute('session');
                    $this->assertInstanceOf(Session::class, $session);

                    echo $session->getName();
                },
            ]
        );

        $this->assertEquals('custom-session', (string) $response->getBody());
    }

    public function testCustomAttribute()
    {
        $response = Dispatcher::run(
            [
                (new AuraSession())->attribute('my-session'),

                function ($request) {
                    $session = $request->getAttribute('my-session');
                    $this->assertInstanceOf(Session::class, $session);

                    echo $session->getName();
                },
            ]
        );

        $this->assertEquals('PHPSESSID', (string) $response->getBody());
    }
}
