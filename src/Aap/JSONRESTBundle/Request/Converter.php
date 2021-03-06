<?php

namespace Aap\JSONRESTBundle\Request;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class Converter
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function jsonToPost()
    {
        /** @var Request $request */
        $request = $this->container->get('request');
        $data = json_decode($request->getContent(), true);

        $request->request->add($data);
    }
}