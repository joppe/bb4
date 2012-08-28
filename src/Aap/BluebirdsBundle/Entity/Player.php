<?php

namespace Aap\BluebirdsBundle\Entity;

use Aap\BluebirdsBundle\Entity\TeamMember;
use Aap\BluebirdsBundle\Entity\Game;
use Aap\BluebirdsBundle\Entity\Position;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="player")
 */
class Player {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $played_time;

    /**
     * @ORM\ManyToOne(targetEntity="TeamMember", inversedBy="players")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    protected $team_member;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="players")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    protected $game;

    /**
     * @ORM\OneToMany(targetEntity="Position", mappedBy="player")
     */
    protected $positions;

    /**
     * Constructor
     */
    public function __construct() {
        $this->positions = new ArrayCollection();
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
     * Set team_member
     *
     * @param Aap\BluebirdsBundle\Entity\TeamMember $teamMember
     * @return Player
     */
    public function setTeamMember(\Aap\BluebirdsBundle\Entity\TeamMember $teamMember = null)
    {
        $this->team_member = $teamMember;
    
        return $this;
    }

    /**
     * Get team_member
     *
     * @return Aap\BluebirdsBundle\Entity\TeamMember 
     */
    public function getTeamMember()
    {
        return $this->team_member;
    }

    /**
     * Set game
     *
     * @param Aap\BluebirdsBundle\Entity\Game $game
     * @return Player
     */
    public function setGame(\Aap\BluebirdsBundle\Entity\Game $game = null)
    {
        $this->game = $game;
    
        return $this;
    }

    /**
     * Get game
     *
     * @return Aap\BluebirdsBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Add positions
     *
     * @param Aap\BluebirdsBundle\Entity\Position $positions
     * @return Player
     */
    public function addPosition(\Aap\BluebirdsBundle\Entity\Position $positions)
    {
        $this->positions[] = $positions;
    
        return $this;
    }

    /**
     * Remove positions
     *
     * @param Aap\BluebirdsBundle\Entity\Position $positions
     */
    public function removePosition(\Aap\BluebirdsBundle\Entity\Position $positions)
    {
        $this->positions->removeElement($positions);
    }

    /**
     * Get positions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * Set played_time
     *
     * @param integer $playedTime
     * @return Player
     */
    public function setPlayedTime($playedTime)
    {
        $this->played_time = $playedTime;
    
        return $this;
    }

    /**
     * Get played_time
     *
     * @return integer 
     */
    public function getPlayedTime()
    {
        return $this->played_time;
    }
}