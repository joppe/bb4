<?php

namespace Aap\BluebirdsBundle\Entity;

use Aap\BluebirdsBundle\Entity\Team;
use Aap\BluebirdsBundle\Entity\Member;
use Aap\BluebirdsBundle\Entity\PreferredPosition;
use Aap\BluebirdsBundle\Entity\Player;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="team_member")
 */
class TeamMember {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="team_members")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    protected $team;

    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="team_members")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    protected $member;

    /**
     * @ORM\OneToMany(targetEntity="PreferredPosition", mappedBy="team_member")
     */
    protected $preferred_positions;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->preferred_positions = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set team
     *
     * @param \Aap\BluebirdsBundle\Entity\Team $team
     * @return TeamMember
     */
    public function setTeam(\Aap\BluebirdsBundle\Entity\Team $team = null)
    {
        $this->team = $team;
    
        return $this;
    }

    /**
     * Get team
     *
     * @return \Aap\BluebirdsBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set member
     *
     * @param \Aap\BluebirdsBundle\Entity\Member $member
     * @return TeamMember
     */
    public function setMember(\Aap\BluebirdsBundle\Entity\Member $member = null)
    {
        $this->member = $member;
    
        return $this;
    }

    /**
     * Get member
     *
     * @return \Aap\BluebirdsBundle\Entity\Member 
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Add preferred_positions
     *
     * @param \Aap\BluebirdsBundle\Entity\PreferredPosition $preferredPositions
     * @return TeamMember
     */
    public function addPreferredPosition(\Aap\BluebirdsBundle\Entity\PreferredPosition $preferredPositions)
    {
        $this->preferred_positions[] = $preferredPositions;
    
        return $this;
    }

    /**
     * Remove preferred_positions
     *
     * @param \Aap\BluebirdsBundle\Entity\PreferredPosition $preferredPositions
     */
    public function removePreferredPosition(\Aap\BluebirdsBundle\Entity\PreferredPosition $preferredPositions)
    {
        $this->preferred_positions->removeElement($preferredPositions);
    }

    /**
     * Get preferred_positions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreferredPositions()
    {
        return $this->preferred_positions;
    }
}