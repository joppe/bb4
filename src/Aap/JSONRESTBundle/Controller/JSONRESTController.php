<?php

namespace Aap\JSONRESTBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Aap\JSONRESTBundle\Response\JSONRESTResponse;

class JSONRESTController extends Controller
{
    /**
     * @var Registry $doctrine
     */
    private $doctrine;

    /**
     * @var FormFactory $formFactory
     */
    private $formFactory;

    /**
     * @param Registry $doctrine
     * @param FormFactory $formFactory
     */
    public function __construct(Registry $doctrine, FormFactory $formFactory)
    {
        $this->doctrine = $doctrine;
        $this->formFactory = $formFactory;
    }

    /**
     * @param string $className
     * @return JSONRESTResponse
     */
    public function getAction($className)
    {
        $error = false;
        $collection = null;

        $collection = $this
            ->doctrine
            ->getRepository($className)
            ->findAll();

        $collection = array_map(function ($entity) {
            return $entity->asData();
        }, $collection);

        return new JSONRESTResponse($collection, $error);
    }

    /**
     * @param string $className
     * @param int $id
     * @return JSONRESTResponse
     */
    public function getOneAction($className, $id)
    {
        $error = false;
        $entity = $this
            ->doctrine
            ->getRepository($className)
            ->find($id);

        if ($entity) {
            $entity = $entity->asData();
        } else {
            $entity = null;
            $error = $className . ' with id "' . $id . '" not found.';
        }

        return new JSONRESTResponse($entity, $error);
    }

    /**
     * @param $className
     * @param Request $request
     * @return JSONRESTResponse
     */
    public function postAction($className, $request)
    {
        $error = false;
        $entity = new $className();
        $formType = $this->createFormType($className);

        $form = $this->formFactory->create($formType, $entity);
        $request->request->set($formType->getName(), $request->request->all());
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->doctrine->getManager();
            $em->persist($entity);
            $em->flush();

            $entity = $entity->asData();
        } else {
            $error = 'Unable to create entity with className "' . $className . '"';
            $entity = null;
        }

        return new JSONRESTResponse($entity, $error);
    }

    /**
     * @param string $className
     * @param int $id
     * @param Request $request
     * @return JSONRESTResponse
     */
    public function putAction($className, $id, $request)
    {
        $error = false;
        $entity = $this
                ->doctrine
                ->getRepository($className)
                ->find($id);

        if ($entity) {
            $formType = $this->createFormType($className);
            $request->request->set($formType->getName(), $request->request->all());
            $form = $this->formFactory->create($formType, $entity);
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->doctrine->getManager();
                $em->persist($entity);
                $em->flush();
                $entity = $entity->asData();
            } else {
                $error = 'Unable to update entity with className "' . $className . '"';
                $entity = null;
            }
        } else {
            $error = $className . ' with id "' . $id . '" not found.';
            $entity = null;
        }

        return new JSONRESTResponse($entity, $error);
    }

    /**
     * @param string $className
     * @param int $id
     * @return JSONRESTResponse
     */
    public function deleteAction($className, $id)
    {
        $error = false;
        $entity = $this
                ->doctrine
                ->getRepository($className)
                ->find($id);

        if ($entity) {
            $em = $this->doctrine->getManager();
            $em->remove($entity);
            $em->flush();
        } else {
            $error = $className . ' with id "' . $id . '" not found.';
            $entity = null;
        }

        return new JSONRESTResponse($entity, $error);
    }

    /**
     * @param string $className
     * @return \Symfony\Component\Form\AbstractType
     */
    protected function createFormType($className)
    {
        $formType = str_replace('\\Entity\\', '\\Form\\Type\\', $className) . 'Type';
        return new $formType();
    }
}