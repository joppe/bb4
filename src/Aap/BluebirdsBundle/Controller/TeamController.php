<?php

namespace Aap\BluebirdsBundle\Controller;

use Aap\BluebirdsBundle\Entity\Team;
use Aap\BluebirdsBundle\Form\Type\TeamType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends Controller {
    /**
     * Display all teams
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction() {
        $teams = $this
                    ->getDoctrine()
                    ->getRepository('AapBluebirdsBundle:Team')
                    ->findAll()
        ;

        return $this->render('AapBluebirdsBundle:Team:list.html.twig', array(
            'teams' => $teams
        ));
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $team = new Team();

        $form = $this->createForm(new TeamType(), $team);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $team = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($team);
                $em->flush();

                return $this->redirect($this->generateUrl('team_list'));
            }
        }

        return $this->render('AapBluebirdsBundle:Team:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Display the team homepage
     *
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function teamAction($slug) {
//        return new Response('team ' . $name);
        return $this->render('AapBluebirdsBundle:Team:team.html.twig', array(
            'team_name' => 'Blue Birds 4'
        ));
    }
}