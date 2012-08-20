<?php

namespace Aap\BluebirdsBundle\Controller;

use Aap\BluebirdsBundle\Entity\Team;
use Aap\BluebirdsBundle\Entity\Player;
//use Aap\BluebirdsBundle\Form\Type\PlayerType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends Controller {
    public function createAction($team_id) {
        return new Response('create player');

    }
    public function editAction($team_id, $id) {
        return new Response('edit player');
    }
    public function deleteAction($team_id, $id) {
        return new Response('delete player');
    }
}