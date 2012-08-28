<?php

namespace Aap\BluebirdsBundle\Controller;

use Aap\BluebirdsBundle\Entity\Member;
use Aap\BluebirdsBundle\Form\Type\MemberType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MemberController extends Controller {
    /**
     * Display all members
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction() {
        $members = $this
            ->getDoctrine()
            ->getRepository('AapBluebirdsBundle:Member')
            ->findAll()
        ;

        return $this->render('AapBluebirdsBundle:Member:list.html.twig', array(
            'members' => $members
        ));
    }

    /**
     * Create a member
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $member = new Member();

        $form = $this->createForm(new MemberType(), $member);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $member = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($member);
                $em->flush();

                return $this->redirect($this->generateUrl('member_list'));
            }
        }

        return $this->render('AapBluebirdsBundle:Member:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Display a member's details
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction($id) {
        $member = $this->getDoctrine()
            ->getRepository('AapBluebirdsBundle:Member')
            ->find($id);

        if (!$member) {
            $this->forward($this->generateUrl('member_list'));
        }
        var_dump(get_class($member)); die();
        return $this->render('AapBluebirdsBundle:Member:detail.html.twig', array(
            'member' => $member,
        ));
    }

    /**
     * Delete a member
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $member = $em
            ->getRepository('AapBluebirdsBundle:Member')
            ->find($id);

        if ($member) {
            $em->remove($member);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('member_list'));
    }

    /**
     * Edit a member
     *
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $member = $em
            ->getRepository('AapBluebirdsBundle:Member')
            ->find($id);

        if (!$member) {
            $this->redirect($this->generateUrl('member_list'));
        }

        $form = $this->createForm(new MemberType(), $member);
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $member = $form->getData();
                $em->persist($member);
                $em->flush();

                return $this->redirect($this->generateUrl('member_list'));
            }
        }

        return $this->render('AapBluebirdsBundle:Member:edit.html.twig', array(
            'member' => $member,
            'form' => $form->createView(),
        ));
    }
}