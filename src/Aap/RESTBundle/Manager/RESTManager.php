<?php

namespace Aap\RESTBundle\Manager;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Form\FormFactory;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\HttpFoundation\Request;

class RESTManager
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
     * @param string $vendor
     * @param string $bundle
     * @param $entityName
     * @return array
     */
    public function get($vendor, $bundle, $entityName)
    {
        return $this->getRepository($vendor, $bundle, $entityName)->findAll();
    }

    /**
     * @param string $vendor
     * @param string $bundle
     * @param string $entityName
     * @param int $id
     * @return object
     */
    public function getOne($vendor, $bundle, $entityName, $id)
    {
        return $this->getRepository($vendor, $bundle, $entityName)->find($id);
    }

    /**
     * @param $vendor
     * @param $bundle
     * @param $entityName
     * @param Request $request
     * @return Entity
     */
    public function post($vendor, $bundle, $entityName, $request)
    {
        $em = $this->doctrine->getManager();

        $entity = $this->createEntity($vendor, $bundle, $entityName);
        $formType = $this->createFormType($vendor, $bundle, $entityName);

        $form = $this->formFactory->create($formType, $entity);

        if ($request->isMethod('POST')) {
            $request->request->set($formType->getName(), $request->request->all());

            $form->bind($request);

            if ($form->isValid()) {
                $em->persist($entity);
                $em->flush();
            }
        }

        return $entity;
    }

    public function put($vendor, $bundle, $entityName, $id, $request)
    {
        $em = $this->doctrine->getManager();

        $entity = $this->getRepository($vendor, $bundle, $entityName)->find($id);
        $formType = $this->createFormType($vendor, $bundle, $entityName);

        $form = $this->formFactory->create($formType, $entity);

        if ($request->isMethod('POST')) {
            $request->request->set($formType->getName(), $request->request->all());

            $form->bind($request);

            if ($form->isValid()) {
                $em->persist($entity);
                $em->flush();
            }
        }

        return $entity;
    }

    public function delete($vendor, $bundle, $entityName, $id)
    {
        $entity = $this->getRepository($vendor, $bundle, $entityName)->find($id);

        $em = $this->doctrine->getManager();
        $em->remove($entity);
        $em->flush();
    }

    /**
     * @param string $vendor
     * @param string $bundle
     * @param string $entityName
     * @return string
     */
    protected function createFormType($vendor, $bundle, $entityName)
    {
        $className = $vendor . '\\' . $bundle . '\\Form\\Type\\' . $entityName . 'Type';
        return new $className();
    }

    /**
     * @param string $vendor
     * @param string $bundle
     * @param string $entityName
     * @return string
     */
    protected function createEntity($vendor, $bundle, $entityName)
    {
        $className = $vendor . '\\' . $bundle . '\\Entity\\' . $entityName;
        return new $className();
    }

    /**
     * @param string $vendor
     * @param string $bundle
     * @param string $entityName
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getRepository($vendor, $bundle, $entityName)
    {
        return $this->doctrine->getRepository($vendor . $bundle . ':' . $entityName);
    }
}