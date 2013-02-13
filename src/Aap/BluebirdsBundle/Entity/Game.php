<?php

namespace Aap\BluebirdsBundle\Entity;

use Aap\BluebirdsBundle\Entity\Team;
use Aap\BluebirdsBundle\Entity\Player;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="game")
 */
class Game {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_time;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="home_games")
     * @ORM\JoinColumn(name="home_team_id", referencedColumnName="id")
     */
    protected $home_team;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="away_games")
     * @ORM\JoinColumn(name="away_team_id", referencedColumnName="id")
     */
    protected $away_team;

    /**
     * @ORM\Column(type="integer")
     */
    protected $score_home_team;

    /**
     * @ORM\Column(type="integer")
     */
    protected $score_away_team;

    /**
     * @ORM\OneToMany(targetEntity="Player", mappedBy="game")
     */
    protected $players;
    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set date_time
     *
     * @param \DateTime $dateTime
     * @return Game
     */
    public function setDateTime($dateTime)
    {
        $this->date_time = $dateTime;
    
        return $this;
    }

    /**
     * Get date_time
     *
     * @return \DateTime 
     */
    public function getDateTime()
    {
        return $this->date_time;
    }

    /**
     * Set score_home_team
     *
     * @param integer $scoreHomeTeam
     * @return Game
     */
    public function setScoreHomeTeam($scoreHomeTeam)
    {
        $this->score_home_team = $scoreHomeTeam;
    
        return $this;
    }

    /**
     * Get score_home_team
     *
     * @return integer 
     */
    public function getScoreHomeTeam()
    {
        return $this->score_home_team;
    }

    /**
     * Set score_away_team
     *
     * @param integer $scoreAwayTeam
     * @return Game
     */
    public function setScoreAwayTeam($scoreAwayTeam)
    {
        $this->score_away_team = $scoreAwayTeam;
    
        return $this;
    }

    /**
     * Get score_away_team
     *
     * @return integer 
     */
    public function getScoreAwayTeam()
    {
        return $this->score_away_team;
    }

    /**
     * Set home_team
     *
     * @param \Aap\BluebirdsBundle\Entity\Team $homeTeam
     * @return Game
     */
    public function setHomeTeam(\Aap\BluebirdsBundle\Entity\Team $homeTeam = null)
    {
        $this->home_team = $homeTeam;
    
        return $this;
    }

    /**
     * Get home_team
     *
     * @return \Aap\BluebirdsBundle\Entity\Team 
     */
    public function getHomeTeam()
    {
        return $this->home_team;
    }

    /**
     * Set away_team
     *
     * @param \Aap\BluebirdsBundle\Entity\Team $awayTeam
     * @return Game
     */
    public function setAwayTeam(\Aap\BluebirdsBundle\Entity\Team $awayTeam = null)
    {
        $this->away_team = $awayTeam;
    
        return $this;
    }

    /**
     * Get away_team
     *
     * @return \Aap\BluebirdsBundle\Entity\Team 
     */
    public function getAwayTeam()
    {
        return $this->away_team;
    }

    /**
     * Add players
     *
     * @param \Aap\BluebirdsBundle\Entity\Player $players
     * @return Game
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