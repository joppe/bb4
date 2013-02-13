<?php

namespace Aap\BluebirdsBundle\Entity;

use Aap\BluebirdsBundle\Entity\Player;
use Aap\BluebirdsBundle\Entity\Position;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="player_position")
 */
class PlayerPosition {
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
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="positions")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    protected $player;

    /**
     * @ORM\ManyToOne(targetEntity="Position", inversedBy="player_positions")
     * @ORM\JoinColumn(name="postiton_id", referencedColumnName="id")
     */
    protected $position;

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
     * @return PlayerPosition
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
     * Set player
     *
     * @param \Aap\BluebirdsBundle\Entity\Player $player
     * @return PlayerPosition
     */
    public function setPlayer(\Aap\BluebirdsBundle\Entity\Player $player = null)
    {
        $this->player = $player;
    
        return $this;
    }

    /**
     * Get player
     *
     * @return \Aap\BluebirdsBundle\Entity\Player 
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set position
     *
     * @param \Aap\BluebirdsBundle\Entity\Position $position
     * @return PlayerPosition
     */
    public function setPosition(\Aap\BluebirdsBundle\Entity\Position $position = null)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return \Aap\BluebirdsBundle\Entity\Position 
     */
    public function getPosition()
    {
        return $this->position;
    }
}