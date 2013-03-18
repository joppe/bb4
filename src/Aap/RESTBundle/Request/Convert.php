<?php

namespace Aap\RESTBundle\Request;

use Symfony\Component\Routing\Router;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Convert
{
    public function __construct(ContainerInterface $container, Router $router)
    {
        $this->container = $container;
        $this->router = $router;
    }

    public function toPost()
    {
        $request = $this->container->get('request');
        $data = json_decode($request->getContent(), true);

        $route = $this->router->match($request->getPathInfo());
        $entityName = $route['entityName'];

        $post = array(
            $entityName => $data
        );

        $request->request->add($post);
    }
}