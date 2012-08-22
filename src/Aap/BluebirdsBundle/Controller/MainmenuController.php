<?php

namespace Aap\BluebirdsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainmenuController extends Controller {
    public function menuItemsAction() {
        $menu_items = array(
            array(
                'title' => 'Teams',
                'identifier' => 'team',
                'href' => $this->generateUrl('team_list'),
            ),
            array(
                'title' => 'Members',
                'identifier' => 'member',
                'href' => $this->generateUrl('member_list'),
            ),
        );

        $active = null;
        $path = preg_replace('/^\//', '', $this->getRequest()->server->get('PATH_INFO'));
        $path_parts = explode('/', $path);
        if (count($path_parts) > 0) {
            $active = $path_parts[0];
        }

        return $this->render('AapBluebirdsBundle:Mainmenu:menuItems.html.twig', array(
            'menu_items' => $menu_items,
            'active' => $active
        ));
    }
}