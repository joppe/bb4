<?php

namespace Aap\BluebirdsBundle\Entity;

use Aap\BluebirdsBundle\Entity\Club;
use Aap\BluebirdsBundle\Entity\TeamMember;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="member")
 */
class Member
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $middle_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $last_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $mobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $street;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $zip;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $membership_number;

    /**
     * @ORM\ManyToOne(targetEntity="Club", inversedBy="members")
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id")
     */
    protected $club;

    /**
     * @ORM\OneToMany(targetEntity="TeamMember", mappedBy="member")
     */
    protected $team_members;

    /**
     * @ORM\OneToMany(targetEntity="Player", mappedBy="member")
     */
    protected $players;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->team_members = new \Doctrine\Common\Collections\ArrayCollection();
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set first_name
     *
     * @param string $firstName
     * @return Member
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    
        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set middle_name
     *
     * @param string $middleName
     * @return Member
     */
    public function setMiddleName($middleName)
    {
        $this->middle_name = $middleName;
    
        return $this;
    }

    /**
     * Get middle_name
     *
     * @return string 
     */
    public function getMiddleName()
    {
        return $this->middle_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return Member
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    
        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Member
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Member
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    
        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Member
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    
        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Member
     */
    public function setStreet($street)
    {
        $this->street = $street;
    
        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return Member
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    
        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Member
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set membership_number
     *
     * @param string $membershipNumber
     * @return Member
     */
    public function setMembershipNumber($membershipNumber)
    {
        $this->membership_number = $membershipNumber;
    
        return $this;
    }

    /**
     * Get membership_number
     *
     * @return string 
     */
    public function getMembershipNumber()
    {
        return $this->membership_number;
    }

    /**
     * Set club
     *
     * @param \Aap\BluebirdsBundle\Entity\Club $club
     * @return Member
     */
    public function setClub(\Aap\BluebirdsBundle\Entity\Club $club = null)
    {
        $this->club = $club;
    
        return $this;
    }

    /**
     * Get club
     *
     * @return \Aap\BluebirdsBundle\Entity\Club 
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Add team_members
     *
     * @param \Aap\BluebirdsBundle\Entity\TeamMember $teamMembers
     * @return Member
     */
    public function addTeamMember(\Aap\BluebirdsBundle\Entity\TeamMember $teamMembers)
    {
        $this->team_members[] = $teamMembers;
    
        return $this;
    }

    /**
     * Remove team_members
     *
     * @param \Aap\BluebirdsBundle\Entity\TeamMember $teamMembers
     */
    public function removeTeamMember(\Aap\BluebirdsBundle\Entity\TeamMember $teamMembers)
    {
        $this->team_members->removeElement($teamMembers);
    }

    /**
     * Get team_members
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeamMembers()
    {
        return $this->team_members;
    }

    /**
     * Add players
     *
     * @param \Aap\BluebirdsBundle\Entity\Player $players
     * @return Member
     */
    public function addPlayer(\Aap\BluebirdsBundle\Entity\Player $players)
    {
        $this->players[] = $players;
    
        return $this;
    }

    /**
     * Remove players
     *
     * @param \Aap\BluebirdsBundle\Entity\Player $players
     */
    public function removePlayer(\Aap\BluebirdsBundle\Entity\Player $players)
    {
        $this->players->removeElement($players);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayers()
    {
        return $this->players;
    }
}