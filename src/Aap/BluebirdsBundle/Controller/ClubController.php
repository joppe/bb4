<?php

namespace Aap\BluebirdsBundle\Controller;

use Aap\BluebirdsBundle\Entity\Club;
use Aap\BluebirdsBundle\Form\Type\ClubType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClubController extends Controller {
    /**
     * Display all positions
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction() {
        $clubs = $this
            ->getDoctrine()
            ->getRepository('AapBluebirdsBundle:Club')
            ->findAll()
        ;

        return $this->render('AapBluebirdsBundle:Club:list.html.twig', array(
            'clubs' => $clubs
        ));
    }

    /**
     * Create a club
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $club = new Club();

        $form = $this->createForm(new ClubType(), $club);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $club = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($club);
                $em->flush();

                return $this->redirect($this->generateUrl('club_list'));
            }
        }

        return $this->render('AapBluebirdsBundle:Club:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Display a club's details
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction($id) {
        $club = $this->getDoctrine()
            ->getRepository('AapBluebirdsBundle:Club')
            ->find($id);

        if (!$club) {
            $this->forward($this->generateUrl('club_list'));
        }

        return $this->render('AapBluebirdsBundle:Club:detail.html.twig', array(
            'club' => $club,
        ));
    }

    /**
     * Delete a club
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $club = $em
            ->getRepository('AapBluebirdsBundle:Club')
            ->find($id);

        if ($club) {
            $em->remove($club);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('club_list'));
    }

    /**
     * Edit a club
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $club = $em
            ->getRepository('AapBluebirdsBundle:Club')
            ->find($id);

        if (!$club) {
            $this->redirect($this->generateUrl('club_list'));
        }

        $form = $this->createForm(new ClubType(), $club);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $club = $form->getData();
                $em->persist($club);
                $em->flush();

                return $this->redirect($this->generateUrl('club_list'));
            }
        }

        return $this->render('AapBluebirdsBundle:Club:edit.html.twig', array(
            'club' => $club,
            'form' => $form->createView(),
        ));
    }
}