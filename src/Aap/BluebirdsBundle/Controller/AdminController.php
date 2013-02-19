<?php

namespace Aap\BluebirdsBundle\Controller;

use Aap\BluebirdsBundle\Entity\Club;
use Aap\BluebirdsBundle\Entity\Repository\RESTRepositoryInterface;

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
        $className = 'Aap\\BluebirdsBundle\\Entity\\' . $entityName;

        if (class_exists($className)) {
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
        $error = false;
        $entity = null;
        $className = 'Aap\\BluebirdsBundle\\Entity\\' . $entityName;

        if (class_exists($className)) {
            $entity = $this
                ->getDoctrine()
                ->getRepository('AapBluebirdsBundle:' . $entityName)
                ->find($id)
            ;

            if ($entity) {
                $entity = $entity->asData();
            } else {
                $error = '"' . $entityName. '" with id ' . $id . ' does not exist';
            }
        } else {
            $error = 'Entity "' . $entityName . '" does not exist';
        }

        return new JsonResponse(array(
            'error' => $error,
            'result' => $entity !== null ? $entity->asData() : null
        ));
    }

    /**
     * @Route("/{entityName}/{id}")
     * @Method({"POST"})
     * @param string $entityName
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createModelAction($entityName, $id)
    {
        $error = false;
        $entity = null;
        $className = 'Aap\\BluebirdsBundle\\Entity\\' . $entityName;

        if (class_exists($className)) {
            $data = json_decode($this->getRequest()->getContent(), true);
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AapBluebirdsBundle:' . $entityName);
            $entity = new $className();

            if ($repository instanceof RESTRepositoryInterface) {
                $entity = $repository->hydrate($entity, $data);
            } else {
                $entity->loadData($data);
            }

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

    /**
     * @Route("/{entityName}/{id}")
     * @Method("PUT")
     * @param string $entityName
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateModelAction($entityName, $id)
    {
        $error = false;
        $entity = null;

        if (class_exists('Aap\\BluebirdsBundle\\Entity\\' . $entityName)) {
            $data = json_decode($this->getRequest()->getContent(), true);
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AapBluebirdsBundle:' . $entityName);
            $entity = $repository->find($id);

            if ($entity) {
                if ($repository instanceof RESTRepositoryInterface) {
                    $entity = $repository->hydrate($entity, $data);
                } else {
                    $entity->loadData($data);
                }

                $em->persist($entity);
                $em->flush();
            } else {
                $error = $entityName . ' with id "' . $id . '" not found.';
            }
        } else {
            $error = 'Entity "' . $entityName . '" does not exist';
        }

        return new JsonResponse(array(
            'error' => $error,
            'result' => $entity !== null ? $entity->asData() : null
        ));
    }

    /**
     * @Route("/{entityName}/{id}")
     * @Method("DELETE")
     * @param $entityName
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function deleteModelAction($entityName, $id)
    {
        $error = false;
        $entity = null;

        if (class_exists('Aap\\BluebirdsBundle\\Entity\\' . $entityName)) {
            $entity = $this->getDoctrine()
                ->getRepository('AapBluebirdsBundle:' . $entityName)
                ->find($id);

            if ($entity) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($entity);
                $em->flush();
            } else {
                $error = $entityName . ' with id "' . $id . '" not found.';
            }
        } else {
            $error = 'Entity "' . $entityName . '" does not exist';
        }

        return new JsonResponse(array(
            'error' => $error,
            'result' => null
        ));
    }
}