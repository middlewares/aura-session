<?php

namespace Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Interop\Http\Middleware\ServerMiddlewareInterface;
use Interop\Http\Middleware\DelegateInterface;
use Aura\Session\SessionFactory;
use Aura\Session\Session;

class AuraSession implements ServerMiddlewareInterface
{
    /**
     * @var SessionFactory
     */
    private $factory;

    /**
     * @var string|null The session name
     */
    private $name;

    /**
     * @var string The attribute name
     */
    private $attribute = 'session';

    /**
     * Set the session factory.
     *
     * @param SessionFactory|null $factory
     */
    public function __construct(SessionFactory $factory = null)
    {
        $this->factory = $factory;
    }

    /**
     * Set the session name.
     *
     * @param string $name
     *
     * @return self
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the attribute name to store the sesion instance.
     *
     * @param string $attribute
     *
     * @return self
     */
    public function attribute($attribute)
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * Process a server request and return a response.
     *
     * @param ServerRequestInterface $request
     * @param DelegateInterface      $delegate
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $factory = $this->factory ?: new SessionFactory();
        $session = $factory->newInstance($request->getCookieParams());

        if ($this->name !== null) {
            $session->setName($this->name);
        }

        $request = $request->withAttribute($this->attribute, $session);

        return $delegate->process($request);
    }
}
