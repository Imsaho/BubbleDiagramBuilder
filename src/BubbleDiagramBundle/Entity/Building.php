<?php

namespace BubbleDiagramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Building
 *
 * @ORM\Table(name="building")
 * @ORM\Entity(repositoryClass="BubbleDiagramBundle\Repository\BuildingRepository")
 */
class Building
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="GBA", type="float", nullable=true)
     */
    private $GBA;

    /**
     * @var float
     *
     * @ORM\Column(name="NBA", type="float", nullable=true)
     */
    private $NBA;

    /**
     * @var float
     *
     * @ORM\Column(name="NBA_factor", type="float")
     */
    private $NBAFactor;

    /**
     * @var string
     *
     * @ORM\Column(name="coordinates", type="string", length=255, nullable=true)
     */
    private $coordinates;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
    /**
     * @ORM\OneToOne(targetEntity="Team", inversedBy="building")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $team;


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
     * @return Building
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
     * Set gBA
     *
     * @param float $GBA
     * @return Building
     */
    public function setGBA($GBA)
    {
        $this->GBA = $GBA;

        return $this;
    }

    /**
     * Get GBA
     *
     * @return float 
     */
    public function getGBA()
    {
        return $this->GBA;
    }

    /**
     * Set nBA
     *
     * @param float $NBA
     * @return Building
     */
    public function setNBA($NBA)
    {
        $this->NBA = $NBA;

        return $this;
    }

    /**
     * Get NBA
     *
     * @return float 
     */
    public function getNBA()
    {
        return $this->NBA;
    }

    /**
     * Set NBAFactor
     *
     * @param float $NBAFactor
     * @return Building
     */
    public function setNBAFactor($NBAFactor)
    {
        $this->NBAFactor = $NBAFactor;

        return $this;
    }

    /**
     * Get NBAFactor
     *
     * @return float 
     */
    public function getNBAFactor()
    {
        return $this->NBAFactor;
    }

    /**
     * Set coordinates
     *
     * @param string $coordinates
     * @return Building
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    /**
     * Get coordinates
     *
     * @return string 
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Building
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set team
     *
     * @param \BubbleDiagramBundle\Entity\Team $team
     * @return Building
     */
    public function setTeam(\BubbleDiagramBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \BubbleDiagramBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }
}
