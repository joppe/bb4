<?php

namespace Aap\BluebirdsBundle\Controller;

use Aap\BluebirdsBundle\Entity\Position;
use Aap\BluebirdsBundle\Form\Type\PositionType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PositionController extends Controller {
    /**
     * Display all positions
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction() {
        $positions = $this
                    ->getDoctrine()
                    ->getRepository('AapBluebirdsBundle:Position')
                    ->findAll()
        ;

        return $this->render('AapBluebirdsBundle:Position:list.html.twig', array(
            'positions' => $positions,
        ));
    }

    /**
     * Create a position
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $position = new Position();

        $form = $this->createForm(new PositionType(), $position);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $position = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($position);
                $em->flush();

                return $this->redirect($this->generateUrl('position_list'));
            }
        }

        return $this->render('AapBluebirdsBundle:Position:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Display a position's details
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction($id) {
        $position = $this->getDoctrine()
            ->getRepository('AapBluebirdsBundle:Position')
            ->find($id);

        if (!$position) {
            $this->forward($this->generateUrl('position_list'));
        }

        return $this->render('AapBluebirdsBundle:Position:detail.html.twig', array(
            'position' => $position,
        ));
    }

    /**
     * Delete a position
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $position = $em
            ->getRepository('AapBluebirdsBundle:Position')
            ->find($id);

        if ($position) {
            $em->remove($position);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('position_list'));
    }

    /**
     * Edit a position
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $position = $em
            ->getRepository('AapBluebirdsBundle:Position')
            ->find($id);

        if (!$position) {
            $this->redirect($this->generateUrl('position_list'));
        }

        $form = $this->createForm(new PositionType(), $position);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $position = $form->getData();
                $em->persist($position);
                $em->flush();

                return $this->redirect($this->generateUrl('position_list'));
            }
        }

        return $this->render('AapBluebirdsBundle:Position:edit.html.twig', array(
            'position' => $position,
            'form' => $form->createView(),
        ));
    }
}