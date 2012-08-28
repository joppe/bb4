<?php

namespace Aap\BluebirdsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainmenuController extends Controller {
    public function menuItemsAction() {
        $menu_items = array(
            array(
                'title' => 'Clubs',
                'identifier' => 'clubs',
                'href' => $this->generateUrl('club_list'),
            ),
            array(
                'title' => 'Teams',
                'identifier' => 'teams',
                'href' => $this->generateUrl('team_list'),
            ),
            array(
                'title' => 'Members',
                'identifier' => 'members',
                'href' => $this->generateUrl('member_list'),
            ),
            array(
                'title' => 'Positions',
                'identifier' => 'positions',
                'href' => $this->generateUrl('position_list'),
            ),
        );

        $active = null;
        $path = preg_replace('/^\//', '', $this->getRequest()->server->get('PATH_INFO'));
        $path_parts = explode('/', $path);
        if (count($path_parts) > 1) {
            $active = $path_parts[1];
        }

        return $this->render('AapBluebirdsBundle:Mainmenu:menuItems.html.twig', array(
            'menu_items' => $menu_items,
            'active' => $active
        ));
    }
}