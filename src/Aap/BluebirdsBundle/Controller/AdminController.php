<?php

namespace Aap\BluebirdsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Aap\RESTBundle\Response\RESTResponse;
use Symfony\Component\HttpFoundation\Response;

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
     * @return RESTResponse
     */
    public function readCollectionAction($entityName)
    {
        $error = false;
        $collection = null;

        /** @var \Aap\RESTBundle\Manager\RESTManager $restManager */
        $restManager = $this->get('aap_rest.manager');

        try {
            $collection = $restManager->get('Aap\\BluebirdsBundle\\Entity\\' . $entityName);
//            $collection = $restManager->get('Aap', 'BluebirdsBundle', $entityName);

            $collection = array_map(function ($entity) {
                return $entity->asData();
            }, $collection);
        } catch (\Exception $e) {
            $error = (string) $e;
        }

        return new RESTResponse($collection, $error);
    }

    /**
     * @Route("/{entityName}/{id}")
     * @Method("GET")
     * @param string $entityName
     * @param int $id
     * @return RESTResponse
     */
    public function readModelAction($entityName, $id)
    {
        $error = false;
        $entity = null;

        /** @var \Aap\RESTBundle\Manager\RESTManager $restManager */
        $restManager = $this->get('aap_rest.manager');

        try {
            $entity = $restManager->getOne('Aap\\BluebirdsBundle\\Entity\\' . $entityName, $id);

            if ($entity) {
                $entity = $entity->asData();
            }
        } catch (\Exception $e) {
            $error = (string) $e;
        }

        return new RESTResponse($entity, $error);
    }

    /**
     * @Route("/{entityName}")
     * @Method({"POST"})
     * @param string $entityName
     * @return RESTResponse
     */
    public function createModelAction($entityName)
    {
        $error = true;
        $entity = null;

        /** @var \Aap\RESTBundle\Manager\RESTManager $restManager */
        $restManager = $this->get('aap_rest.manager');

        try {
            $entity = $restManager->post('Aap\\BluebirdsBundle\\Entity\\' . $entityName, $this->getRequest());

            if ($entity && $entity->getId()) {
                $entity = $entity->asData();
                $error = false;
            }
        } catch (\Exception $e) {
            $error = (string) $e;
        }

        return new RESTResponse($entity, $error);
    }

    /**
     * @Route("/{entityName}/{id}")
     * @Method("PUT")
     * @param string $entityName
     * @param int $id
     */
    public function updateModelAction($entityName, $id)
    {

    }

    /**
     * @Route("/{entityName}/{id}")
     * @Method("DELETE")
     * @param string $entityName
     * @param int $id
     */
    public function deleteModelAction($entityName, $id)
    {

    }
}