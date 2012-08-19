<?php

namespace Aap\BluebirdsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class BootstrapController extends Controller {
    public function indexAction() {
        return $this->render('AapBluebirdsBundle:Bootstrap:index.html.twig', array());
    }
}