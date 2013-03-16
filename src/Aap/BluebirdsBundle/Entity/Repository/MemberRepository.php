<?php

namespace Aap\BluebirdsBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Aap\BluebirdsBundle\Entity\Team;

class MemberRepository extends EntityRepository implements RESTRepositoryInterface
{
    /**
     * @param \Aap\BluebirdsBundle\Entity\Member $member
     * @param array $data
     * @return \Aap\BluebirdsBundle\Entity\Member
     */
    public function hydrate($member, $data)
    {
        $em = $this->getEntityManager();

        // get the club
        $club = $em->getRepository('AapBluebirdsBundle:Club')->find($data['club_id']);

        // unset the club_id and set the club
        $data['club'] = $club;
        unset($data['club_id']);

        $member->loadData($data);

        return $member;
    }
}