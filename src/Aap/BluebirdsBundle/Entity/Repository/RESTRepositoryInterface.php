<?php

namespace Aap\BluebirdsBundle\Entity\Repository;

interface RESTRepositoryInterface
{
    public function hydrate($entity, $data);
}