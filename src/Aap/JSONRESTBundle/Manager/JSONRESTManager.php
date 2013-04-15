<?php

namespace Aap\JSONRESTBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Form\FormFactory;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\HttpFoundation\Request;

class JSONRESTManager
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
     * @return mixed
     */
    public function get($className)
    {
        return $this
                ->doctrine
                ->getRepository($className)
                ->findAll();
    }

    /**
     * @param string $className
     * @param int $id
     * @return object
     */
    public function getOne($className, $id)
    {
        return $this
                ->doctrine
                ->getRepository($className)
                ->find($id);
    }

    /**
     * @param $className
     * @param Request $request
     * @return Entity
     */
    public function post($className, $request)
    {
        $entity = new $className();
        $formType = $this->createFormType($className);

        $form = $this->formFactory->create($formType, $entity);

        if ($request->isMethod('POST')) {
            $request->request->set($formType->getName(), $request->request->all());

            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->doctrine->getManager();
                $em->persist($entity);
                $em->flush();
            }
        }

        return $entity;
    }

    /**
     * @param string $className
     * @param int $id
     * @param Request $request
     * @return Entity
     */
    public function put($className, $id, $request)
    {
        $entity = $this
                ->doctrine
                ->getRepository($className)
                ->find($id);

        $formType = $this->createFormType($className);

        $form = $this->formFactory->create($formType, $entity);

        if ($request->isMethod('POST')) {
            $request->request->set($formType->getName(), $request->request->all());

            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->doctrine->getManager();
                $em->persist($entity);
                $em->flush();
            }
        }

        return $entity;
    }

    /**
     * @param string $className
     * @param int $id
     */
    public function delete($className, $id)
    {
        $entity = $this
                ->doctrine
                ->getRepository($className)
                ->find($id);

        $em = $this->doctrine->getManager();
        $em->remove($entity);
        $em->flush();
    }

    /**
     * @param string $className
     * @return FormType
     */
    protected function createFormType($className)
    {
        $formType = str_replace('\\Entity\\', '\\Form\\Type\\', $className) . 'Type';
        return new $formType();
    }
}