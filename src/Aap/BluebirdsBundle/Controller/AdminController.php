<?php

namespace Aap\BluebirdsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template
     * @return array
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/{entityName}")
     * @Method("GET")
     * @param string $entityName
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function readCollectionAction($entityName)
    {
        return $this->forward('aap_rest.controller:getAction', array(
            'className' => 'Aap\\BluebirdsBundle\\Entity\\' . $entityName
        ));
    }

    /**
     * @Route("/{entityName}/{id}")
     * @Method("GET")
     * @param string $entityName
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function readModelAction($entityName, $id)
    {
        return $this->forward('aap_rest.controller:getOneAction', array(
            'className' => 'Aap\\BluebirdsBundle\\Entity\\' . $entityName,
            'id' => $id
        ));
    }

    /**
     * @Route("/{entityName}")
     * @Method({"POST"})
     * @param string $entityName
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createModelAction($entityName)
    {
        return $this->forward('aap_rest.controller:postAction', array(
            'className' => 'Aap\\BluebirdsBundle\\Entity\\' . $entityName,
            'request' => $this->getRequest()
        ));
    }

    /**
     * @Route("/{entityName}/{id}")
     * @Method("PUT")
     * @param string $entityName
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateModelAction($entityName, $id)
    {
        return $this->forward('aap_rest.controller:putAction', array(
            'className' => 'Aap\\BluebirdsBundle\\Entity\\' . $entityName,
            'id' => $id,
            'request' => $this->getRequest()
        ));
    }

    /**
     * @Route("/{entityName}/{id}")
     * @Method("DELETE")
     * @param string $entityName
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteModelAction($entityName, $id)
    {
        return $this->forward('aap_rest.controller:deleteAction', array(
            'className' => 'Aap\\BluebirdsBundle\\Entity\\' . $entityName,
            'id' => $id,
            'request' => $this->getRequest()
        ));
    }
}