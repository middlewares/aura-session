# middlewares/aura-session

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-scrutinizer]][link-scrutinizer]
[![Total Downloads][ico-downloads]][link-downloads]
[![SensioLabs Insight][ico-sensiolabs]][link-sensiolabs]

Middleware to manage sessions using [Aura.Session](https://github.com/auraphp/Aura.Session).

**Note:** This middleware is intended for server side only

## Requirements

* PHP >= 5.6
* A [PSR-7](https://packagist.org/providers/psr/http-message-implementation) http mesage implementation ([Diactoros](https://github.com/zendframework/zend-diactoros), [Guzzle](https://github.com/guzzle/psr7), [Slim](https://github.com/slimphp/Slim), etc...)
* A [PSR-15](https://github.com/http-interop/http-middleware) middleware dispatcher ([Middleman](https://github.com/mindplay-dk/middleman), etc...)

## Installation

This package is installable and autoloadable via Composer as [middlewares/aura-session](https://packagist.org/packages/middlewares/aura-session).

```sh
composer require middlewares/aura-session
```

## Example

```php
$dispatcher = new Dispatcher([
	new Middlewares\AuraSession(),

    function ($request) {
        //get the session object
        $session = $request->getAttribute('session');
    }
]);

$response = $dispatcher->dispatch(new ServerRequest());
```

## Options

#### `__construct(Aura\Session\SessionFactory $factory = null)`

To use a custom session factory. If it's not passed, it will be created automatically.

#### `name(string $name)`

The session name. If it's not defined, the default `PHPSESSID` will be used.

#### `attribute(string $attribute)`

The attribute name used to store the session in the session request. By default is `session`.

---

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes and [CONTRIBUTING](CONTRIBUTING.md) for contributing details.

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/middlewares/aura-session.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/middlewares/aura-session/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/g/middlewares/aura-session.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/middlewares/aura-session.svg?style=flat-square
[ico-sensiolabs]: https://img.shields.io/sensiolabs/i/36786f5a-2a15-4399-8817-8f24fcd8c0b4.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/middlewares/aura-session
[link-travis]: https://travis-ci.org/middlewares/aura-session
[link-scrutinizer]: https://scrutinizer-ci.com/g/middlewares/aura-session
[link-downloads]: https://packagist.org/packages/middlewares/aura-session
[link-sensiolabs]: https://insight.sensiolabs.com/projects/36786f5a-2a15-4399-8817-8f24fcd8c0b4
