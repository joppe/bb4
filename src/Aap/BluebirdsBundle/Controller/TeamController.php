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
            'teams' => $teams,
        ));
    }

    /**
     * Create a team
     *
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
            'form' => $form->createView(),
        ));
    }

    /**
     * Display a team details
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction($id) {
        $team = $this->getDoctrine()
            ->getRepository('AapBluebirdsBundle:Team')
            ->find($id);

        if (!$team) {
            $this->forward($this->generateUrl('team_list'));
        }

        return $this->render('AapBluebirdsBundle:Team:detail.html.twig', array(
            'team' => $team,
        ));
    }

    /**
     * Delete a team
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $team = $em
            ->getRepository('AapBluebirdsBundle:Team')
            ->find($id);

        if ($team) {
            $em->remove($team);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('team_list'));
    }

    /**
     * Edit a team
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $team = $em
            ->getRepository('AapBluebirdsBundle:Team')
            ->find($id);

        if (!$team) {
            $this->redirect($this->generateUrl('team_list'));
        }

        $form = $this->createForm(new TeamType(), $team);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $team = $form->getData();
                $em->persist($team);
                $em->flush();

                return $this->redirect($this->generateUrl('team_list'));
            }
        }

        return $this->render('AapBluebirdsBundle:Team:edit.html.twig', array(
            'team' => $team,
            'form' => $form->createView(),
        ));
    }
}