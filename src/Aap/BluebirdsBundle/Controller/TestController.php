<?php

namespace Aap\BluebirdsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Aap\BluebirdsBundle\Entity\Club;
use Aap\BluebirdsBundle\Form\Type\ClubType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/")
 */
class TestController extends Controller
{
    /**
     * @Route()
     * @Template
     * @return Response
     */
    public function indexAction()
    {
        $form = $this->createForm(new ClubType(), new Club());

        return array(
            'form' => $form->createView()
        );
    }
}