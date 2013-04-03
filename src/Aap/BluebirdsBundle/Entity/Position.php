<?php

namespace Aap\BluebirdsBundle\Entity;

use Aap\BluebirdsBundle\Entity\PreferredPosition;
use Aap\BluebirdsBundle\Entity\PlayerPosition;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="position")
 */
class Position {
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
     * @ORM\Column(type="integer")
     */
    protected $field_number;

    /**
     * @ORM\Column(type="integer")
     */
    protected $rating_weight;

    /**
     * @ORM\OneToMany(targetEntity="PreferredPosition", mappedBy="positon")
     */
    protected $preferred_positons;

    /**
     * @ORM\OneToMany(targetEntity="PlayerPosition", mappedBy="position")
     */
    protected $player_positions;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->preferred_positons = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Position
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
     * Set field_number
     *
     * @param integer $fieldNumber
     * @return Position
     */
    public function setFieldNumber($fieldNumber)
    {
        $this->field_number = $fieldNumber;
    
        return $this;
    }

    /**
     * Get field_number
     *
     * @return integer 
     */
    public function getFieldNumber()
    {
        return $this->field_number;
    }

    /**
     * Set rating_weight
     *
     * @param integer $ratingWeight
     * @return Position
     */
    public function setRatingWeight($ratingWeight)
    {
        $this->rating_weight = $ratingWeight;
    
        return $this;
    }

    /**
     * Get rating_weight
     *
     * @return integer 
     */
    public function getRatingWeight()
    {
        return $this->rating_weight;
    }

    /**
     * Add preferred_positons
     *
     * @param \Aap\BluebirdsBundle\Entity\PreferredPosition $preferredPositons
     * @return Position
     */
    public function addPreferredPositon(\Aap\BluebirdsBundle\Entity\PreferredPosition $preferredPositons)
    {
        $this->preferred_positons[] = $preferredPositons;
    
        return $this;
    }

    /**
     * Remove preferred_positons
     *
     * @param \Aap\BluebirdsBundle\Entity\PreferredPosition $preferredPositons
     */
    public function removePreferredPositon(\Aap\BluebirdsBundle\Entity\PreferredPosition $preferredPositons)
    {
        $this->preferred_positons->removeElement($preferredPositons);
    }

    /**
     * Get preferred_positons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPreferredPositons()
    {
        return $this->preferred_positons;
    }

    /**
     * Add player_positions
     *
     * @param \Aap\BluebirdsBundle\Entity\PlayerPosition $playerPositions
     * @return Position
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

    /**
     * @return array
     */
    public function asData()
    {
        return array(
            'id' => (int) $this->getId(),
            'name' => $this->getName(),
            'field_number' => $this->getFieldNumber(),
            'rating_weight' => $this->getRatingWeight(),
        );
    }
}