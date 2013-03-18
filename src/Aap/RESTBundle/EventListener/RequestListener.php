<?php

namespace Aap\RESTBundle\EventListener;

use Aap\RESTBundle\Request\Convert;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RequestListener
{
    public function __construct(ContainerInterface $container, Convert $convert)
    {
        $this->container = $container;
        $this->convert = $convert;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST === $event->getRequestType()) {
            $request = $event->getRequest();

            if ($request->isXmlHttpRequest() && in_array($request->getMethod(), array('POST', 'PUT'))) {
                $this->convert->toPost();
            }
        }
    }
}