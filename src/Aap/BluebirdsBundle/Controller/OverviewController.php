<?php

namespace Aap\BluebirdsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OverviewController extends Controller {
    public function indexAction() {
        return $this->render('AapBluebirdsBundle:Overview:index.html.twig', array(

        ));
    }
}