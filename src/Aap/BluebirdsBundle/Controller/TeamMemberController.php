<?php

namespace Aap\BluebirdsBundle\Controller;

use Aap\BluebirdsBundle\Entity\TeamMember;
use Aap\BluebirdsBundle\Form\Type\TeamMemberType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;

class TeamMemberController extends Controller {
    /**
     * List team members
     *
     * @param \Aap\BluebirdsBundle\Entity\Team $team
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function listAction($team) {
        return $this->render('AapBluebirdsBundle:TeamMember:list.html.twig', array(
            'team' => $team,
        ));
    }

    /**
     * Create a team member
     *
     * @param \Aap\BluebirdsBundle\Entity\Team $team
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction($team, Request $request) {
        $team_member = new TeamMember();
        $team_member->setTeam($team);

        // TODO skip already added team members

        $form = $this->createFormBuilder($team_member)
            ->add('member', 'entity', array(
                'class' => 'AapBluebirdsBundle:Member',
                'query_builder' => function (EntityRepository $er) use ($team) {
                    return $er
                        ->createQueryBuilder('m')
                        ->where('m.club = :club')
                        ->setParameter('club', $team->getClub())
                        ->orderBy('m.first_name', 'ASC')
                    ;
                },
                'property' => 'first_name',
            ))
            ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {

                $team = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($team);
                $em->flush();

//                return $this->redirect($this->generateUrl('team_list'));
            }
        }

        return $this->render('AapBluebirdsBundle:TeamMember:create.html.twig', array(
            'team' => $team,
            'form' => $form->createView(),
        ));
    }

    /**
     * Display a team member's details
     *
     * @param int $team_id
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction($team_id, $id) {
        $team = $this->getDoctrine()
            ->getRepository('AapBluebirdsBundle:Team')
            ->find($team_id);

        if (!$team) {
            $this->forward($this->generateUrl('team_list'));
        }

        return $this->render('AapBluebirdsBundle:Team:detail.html.twig', array(
            'team' => $team,
        ));
    }

    /**
     * Delete a team member
     *
     * @param int $team_id
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($team_id, $id) {
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
     * @param int $team_id
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($team_id, $id) {
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