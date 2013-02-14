<?php

namespace Aap\BluebirdsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route()
     * @Template
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/{entity}")
     * @Method("GET")
     */
    public function getMultipleAction($entity)
    {
        return new JsonResponse(array(
            'entity' => $entity
        ));
    }
}