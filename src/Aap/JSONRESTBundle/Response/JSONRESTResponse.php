<?php

namespace Aap\JSONRESTBundle\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class JSONRESTResponse extends JsonResponse
{
    public function __construct($result, $error = false)
    {
        parent::__construct(array(
            'error' => $error,
            'result' => $result
        ));
    }
}