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
     * @ORM\Column(type="integer")
     */
    protected $at_bat;

    /**
     * @ORM\Column(type="integer")
     */
    protected $runs;

    /**
     * @ORM\Column(type="integer")
     */
    protected $hits;

    /**
     * @ORM\Column(type="integer")
     */
    protected $errors;

    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="players")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    protected $member;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="players")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    protected $game;

    /**
     * @ORM\OneToMany(targetEntity="PlayerPosition", mappedBy="player")
     */
    protected $player_positions;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->player_positions = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set at_bat
     *
     * @param integer $atBat
     * @return Player
     */
    public function setAtBat($atBat)
    {
        $this->at_bat = $atBat;
    
        return $this;
    }

    /**
     * Get at_bat
     *
     * @return integer 
     */
    public function getAtBat()
    {
        return $this->at_bat;
    }

    /**
     * Set runs
     *
     * @param integer $runs
     * @return Player
     */
    public function setRuns($runs)
    {
        $this->runs = $runs;
    
        return $this;
    }

    /**
     * Get runs
     *
     * @return integer 
     */
    public function getRuns()
    {
        return $this->runs;
    }

    /**
     * Set hits
     *
     * @param integer $hits
     * @return Player
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    
        return $this;
    }

    /**
     * Get hits
     *
     * @return integer 
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Set errors
     *
     * @param integer $errors
     * @return Player
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    
        return $this;
    }

    /**
     * Get errors
     *
     * @return integer 
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set member
     *
     * @param \Aap\BluebirdsBundle\Entity\Member $member
     * @return Player
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
     * Set game
     *
     * @param \Aap\BluebirdsBundle\Entity\Game $game
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
     * @return \Aap\BluebirdsBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Add player_positions
     *
     * @param \Aap\BluebirdsBundle\Entity\PlayerPosition $playerPositions
     * @return Player
     */
    public function addPlayerPosition(\Aap\BluebirdsBundle\Entity\PlayerPosition $playerPositions)
    {
        $this->player_positions[] = $playerPositions;
    
        return $this;
    }

    /**
     * Remove player_positions
     *
     * @param \Aap\BluebirdsBundle\Entity\PlayerPosition $playerPositions
     */
    public function removePlayerPosition(\Aap\BluebirdsBundle\Entity\PlayerPosition $playerPositions)
    {
        $this->player_positions->removeElement($playerPositions);
    }

    /**
     * Get player_positions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlayerPositions()
    {
        return $this->player_positions;
    }
}