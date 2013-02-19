<?php

namespace Aap\BluebirdsBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Aap\BluebirdsBundle\Entity\Team;

class TeamRepository extends EntityRepository implements RESTRepositoryInterface
{
    /**
     * @param \Aap\BluebirdsBundle\Entity\Team $team
     * @param array $data
     * @return \Aap\BluebirdsBundle\Entity\Team
     */
    public function hydrate($team, $data)
    {
        $em = $this->getEntityManager();

        // get the club
        $club = $em->getRepository('AapBluebirdsBundle:Club')->find($data['club_id']);

        // unset the club_id and set the club
        $data['club'] = $club;
        unset($data['club_id']);

        $team->loadData($data);

        return $team;
    }
}