<?php

namespace Aap\BluebirdsBundle\Entity;

use Aap\BluebirdsBundle\Entity\Club;
use Aap\BluebirdsBundle\Entity\TeamMember;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="Aap\BluebirdsBundle\Entity\Repository\TeamRepository")
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
     * @ORM\OneToMany(targetEntity="Game", mappedBy="home_team")
     */
    protected $home_games;

    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="away_team")
     */
    protected $away_games;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->team_members = new \Doctrine\Common\Collections\ArrayCollection();
        $this->home_games = new \Doctrine\Common\Collections\ArrayCollection();
        $this->away_games = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \Aap\BluebirdsBundle\Entity\Club $club
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
     * Add home_games
     *
     * @param \Aap\BluebirdsBundle\Entity\Game $homeGames
     * @return Team
     */
    public function addHomeGame(\Aap\BluebirdsBundle\Entity\Game $homeGames)
    {
        $this->home_games[] = $homeGames;
    
        return $this;
    }

    /**
     * Remove home_games
     *
     * @param \Aap\BluebirdsBundle\Entity\Game $homeGames
     */
    public function removeHomeGame(\Aap\BluebirdsBundle\Entity\Game $homeGames)
    {
        $this->home_games->removeElement($homeGames);
    }

    /**
     * Get home_games
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHomeGames()
    {
        return $this->home_games;
    }

    /**
     * Add away_games
     *
     * @param \Aap\BluebirdsBundle\Entity\Game $awayGames
     * @return Team
     */
    public function addAwayGame(\Aap\BluebirdsBundle\Entity\Game $awayGames)
    {
        $this->away_games[] = $awayGames;
    
        return $this;
    }

    /**
     * Remove away_games
     *
     * @param \Aap\BluebirdsBundle\Entity\Game $awayGames
     */
    public function removeAwayGame(\Aap\BluebirdsBundle\Entity\Game $awayGames)
    {
        $this->away_games->removeElement($awayGames);
    }

    /**
     * Get away_games
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAwayGames()
    {
        return $this->away_games;
    }

    /**
     * @param $data
     * @throws \InvalidArgumentException
     */
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'id':
                    // skip
                    break;
                case 'name':
                    $this->setName($value);
                    break;
                case 'club':
                    $this->setClub($value);
                    break;
                default:
                    throw new \InvalidArgumentException("{$key} is not a valid property");
            }
        }
    }

    /**
     * @return array
     */
    public function asData()
    {
        return array(
            'id' => (int) $this->getId(),
            'name' => $this->getName(),
            'club_id' => $this->getClub()->getId()
        );
    }
}