<?php

namespace Aap\BluebirdsBundle\Entity;

use Aap\BluebirdsBundle\Entity\Club;
use Aap\BluebirdsBundle\Entity\TeamMember;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="team")
 */
class Team {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Club", inversedBy="teams")
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id")
     */
    protected $club;

    /**
     * @ORM\OneToMany(targetEntity="TeamMember", mappedBy="team")
     */
    protected $team_members;

    /**
     * Constructor
     */
    public function __construct() {
        $this->team_members = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set club
     *
     * @param Aap\BluebirdsBundle\Entity\Club $club
     * @return Team
     */
    public function setClub(\Aap\BluebirdsBundle\Entity\Club $club = null)
    {
        $this->club = $club;
    
        return $this;
    }

    /**
     * Get club
     *
     * @return Aap\BluebirdsBundle\Entity\Club 
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Add team_members
     *
     * @param Aap\BluebirdsBundle\Entity\TeamMember $teamMembers
     * @return Team
     */
    public function addTeamMember(\Aap\BluebirdsBundle\Entity\TeamMember $teamMembers)
    {
        $this->team_members[] = $teamMembers;
    
        return $this;
    }

    /**
     * Remove team_members
     *
     * @param Aap\BluebirdsBundle\Entity\TeamMember $teamMembers
     */
    public function removeTeamMember(\Aap\BluebirdsBundle\Entity\TeamMember $teamMembers)
    {
        $this->team_members->removeElement($teamMembers);
    }

    /**
     * Get team_members
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTeamMembers()
    {
        return $this->team_members;
    }
}