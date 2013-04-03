<?php

namespace Aap\RESTBundle\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class RESTResponse extends JsonResponse
{
    public function __construct($result, $error = false)
    {
        parent::__construct(array(
            'error' => $error,
            'result' => $result
        ));
    }
}