<?php

namespace Aap\BluebirdsBundle\Entity;

use Aap\BluebirdsBundle\Entity\Member;
use Aap\BluebirdsBundle\Entity\Team;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="club")
 */
class Club {
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
     * @ORM\OneToMany(targetEntity="Member", mappedBy="club")
     */
    protected $members;

    /**
     * @ORM\OneToMany(targetEntity="Team", mappedBy="club")
     */
    protected $teams;

    /**
     * Constructor
     */
    public function __construct() {
        $this->members = new ArrayCollection();
        $this->teams = new ArrayCollection();
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
     * @return Club
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
     * Add members
     *
     * @param Aap\BluebirdsBundle\Entity\Member $members
     * @return Club
     */
    public function addMember(\Aap\BluebirdsBundle\Entity\Member $members)
    {
        $this->members[] = $members;
    
        return $this;
    }

    /**
     * Remove members
     *
     * @param Aap\BluebirdsBundle\Entity\Member $members
     */
    public function removeMember(\Aap\BluebirdsBundle\Entity\Member $members)
    {
        $this->members->removeElement($members);
    }

    /**
     * Get members
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Add teams
     *
     * @param Aap\BluebirdsBundle\Entity\Team $teams
     * @return Club
     */
    public function addTeam(\Aap\BluebirdsBundle\Entity\Team $teams)
    {
        $this->teams[] = $teams;
    
        return $this;
    }

    /**
     * Remove teams
     *
     * @param Aap\BluebirdsBundle\Entity\Team $teams
     */
    public function removeTeam(\Aap\BluebirdsBundle\Entity\Team $teams)
    {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTeams()
    {
        return $this->teams;
    }
}