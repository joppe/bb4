<?php

namespace Aap\BluebirdsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TeamController extends Controller {
    /**
     * Display the team homepage
     *
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($slug) {
//        return new Response('team ' . $name);
        return $this->render('AapBluebirdsBundle:Team:index.html.twig', array(
            'team_name' => 'Blue Birds 4'
        ));
    }
}