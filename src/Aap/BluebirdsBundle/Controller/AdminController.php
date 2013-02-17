<?php

namespace Aap\BluebirdsBundle\Controller;

use Aap\BluebirdsBundle\Entity\Club;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route()
     * @Template
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/{entityName}")
     * @Method("GET")
     * @param string $entityName
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function readCollectionAction($entityName)
    {
        $error = false;
        $collection = null;

        if (class_exists('Aap\\BluebirdsBundle\\Entity\\' . $entityName)) {
            $collection = $this
                ->getDoctrine()
                ->getRepository('AapBluebirdsBundle:' . $entityName)
                ->findAll()
            ;

            $collection = array_map(function ($entity) {
                return $entity->asData();
            }, $collection);
        } else {
            $error = 'Entity "' . $entityName . '" does not exist';
        }

        return new JsonResponse(array(
            'error' => $error,
            'result' => $collection
        ));
    }

    /**
     * @Route("/{entityName}/{id}")
     * @Method("GET")
     * @param string $entityName
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function readModelAction($entityName, $id)
    {
        return new JsonResponse(array(
            'entityName' => $entityName,
            'id' => $id
        ));
    }

    /**
     * @Route("/{entityName}/{id}")
     * @Method({"POST","PUT"})
     * @param string $entityName
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createModelAction($entityName, $id)
    {
        $error = false;
        $entity = null;

        if (class_exists('Aap\\BluebirdsBundle\\Entity\\' . $entityName)) {
            $em = $this->getDoctrine()->getManager();
            $data = json_decode($this->getRequest()->getContent(), true);
            $entity = new Club();

            $entity->loadData($data);

            $em->persist($entity);
            $em->flush();
        } else {
            $error = 'Entity "' . $entityName . '" does not exist';
        }

        return new JsonResponse(array(
            'error' => $error,
            'result' => $entity !== null ? $entity->asData() : null
        ));
    }
}