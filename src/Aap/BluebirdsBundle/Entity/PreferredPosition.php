<?php

namespace Aap\BluebirdsBundle\Entity;

use Aap\BluebirdsBundle\Entity\TeamMember;
use Aap\BluebirdsBundle\Entity\Position;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="preferred_position")
 */
class PreferredPosition {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $rating;

    /**
     * @ORM\ManyToOne(targetEntity="TeamMember", inversedBy="preferred_positions")
     * @ORM\JoinColumn(name="team_member_id", referencedColumnName="id")
     */
    protected $team_member;

    /**
     * @ORM\ManyToOne(targetEntity="Position", inversedBy="preferred_positions")
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     */
    protected $postition;

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
     * Set rating
     *
     * @param integer $rating
     * @return PreferredPosition
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    
        return $this;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set team_member
     *
     * @param \Aap\BluebirdsBundle\Entity\TeamMember $teamMember
     * @return PreferredPosition
     */
    public function setTeamMember(\Aap\BluebirdsBundle\Entity\TeamMember $teamMember = null)
    {
        $this->team_member = $teamMember;
    
        return $this;
    }

    /**
     * Get team_member
     *
     * @return \Aap\BluebirdsBundle\Entity\TeamMember 
     */
    public function getTeamMember()
    {
        return $this->team_member;
    }

    /**
     * Set postition
     *
     * @param \Aap\BluebirdsBundle\Entity\Position $postition
     * @return PreferredPosition
     */
    public function setPostition(\Aap\BluebirdsBundle\Entity\Position $postition = null)
    {
        $this->postition = $postition;
    
        return $this;
    }

    /**
     * Get postition
     *
     * @return \Aap\BluebirdsBundle\Entity\Position 
     */
    public function getPostition()
    {
        return $this->postition;
    }
}