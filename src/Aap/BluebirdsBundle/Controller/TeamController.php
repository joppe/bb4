<?php

namespace Aap\BluebirdsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller {
    public function indexAction($name) {
//        return new Response('team ' . $name);
        return $this->render('AapBluebirdsBundle:Team:index.html.twig', array(
            'team_name' => $name
        ));
    }
}