<?php

namespace BubbleDiagramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Building
 *
 * @ORM\Table(name="building")
 * @ORM\Entity(repositoryClass="BubbleDiagramBundle\Repository\BuildingRepository")
 */
class Building {

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
     * @ORM\OneToMany(targetEntity="Zone", mappedBy="building")
     */
    private $zones;

    /**
     * @ORM\OneToMany(targetEntity="Level", mappedBy="building")
     */
    private $levels;
    
    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="building")
     */
    private $rooms;

    public function __construct() {
        $this->zones = new ArrayCollection();
        $this->levels = new ArrayCollection();
        $this->rooms = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Building
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set gBA
     *
     * @param float $GBA
     * @return Building
     */
    public function setGBA($GBA) {
        $this->GBA = $GBA;

        return $this;
    }

    /**
     * Get GBA
     *
     * @return float 
     */
    public function getGBA() {
        return $this->GBA;
    }

    /**
     * Set nBA
     *
     * @param float $NBA
     * @return Building
     */
    public function setNBA($NBA) {
        $this->NBA = $NBA;

        return $this;
    }

    /**
     * Get NBA
     *
     * @return float 
     */
    public function getNBA() {
        return $this->NBA;
    }

    /**
     * Set NBAFactor
     *
     * @param float $NBAFactor
     * @return Building
     */
    public function setNBAFactor($NBAFactor) {
        $this->NBAFactor = $NBAFactor;

        return $this;
    }

    /**
     * Get NBAFactor
     *
     * @return float 
     */
    public function getNBAFactor() {
        return $this->NBAFactor;
    }

    /**
     * Set coordinates
     *
     * @param string $coordinates
     * @return Building
     */
    public function setCoordinates($coordinates) {
        $this->coordinates = $coordinates;

        return $this;
    }

    /**
     * Get coordinates
     *
     * @return string 
     */
    public function getCoordinates() {
        return $this->coordinates;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Building
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set team
     *
     * @param \BubbleDiagramBundle\Entity\Team $team
     * @return Building
     */
    public function setTeam(\BubbleDiagramBundle\Entity\Team $team = null) {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \BubbleDiagramBundle\Entity\Team 
     */
    public function getTeam() {
        return $this->team;
    }

    /**
     * Add zones
     *
     * @param \BubbleDiagramBundle\Entity\Zone $zones
     * @return Building
     */
    public function addZone(\BubbleDiagramBundle\Entity\Zone $zones) {
        $this->zones[] = $zones;

        return $this;
    }

    /**
     * Remove zones
     *
     * @param \BubbleDiagramBundle\Entity\Zone $zones
     */
    public function removeZone(\BubbleDiagramBundle\Entity\Zone $zones) {
        $this->zones->removeElement($zones);
    }

    /**
     * Get zones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getZones() {
        return $this->zones;
    }

    /**
     * Add levels
     *
     * @param \BubbleDiagramBundle\Entity\Level $levels
     * @return Building
     */
    public function addLevel(\BubbleDiagramBundle\Entity\Level $levels) {
        $this->levels[] = $levels;

        return $this;
    }

    /**
     * Remove levels
     *
     * @param \BubbleDiagramBundle\Entity\Level $levels
     */
    public function removeLevel(\BubbleDiagramBundle\Entity\Level $levels) {
        $this->levels->removeElement($levels);
    }

    /**
     * Get levels
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLevels() {
        return $this->levels;
    }

    public function __toString() {
        return $this->name;
    }

    public function calculateBuildingNBA() {
        $this->NBA = 0;
        foreach ($this->levels as $level) {
            $levelNBA = $level->calculateLevelNBA();
            $this->NBA += $levelNBA;
        }
        return $this->NBA;
    }

    public function calculateBuildingGBA() {
        $this->NBA = $this->calculateBuildingNBA();
        $this->GBA = round(($this->NBA / $this->NBAFactor), 2);
        return $this->GBA;
    }

    public function calculateBuildingPopulation() {
        $totalPeople = 0;
        foreach ($this->levels as $level) {
            $peopleOnLevel = $level->calculatePeopleOnLevel();
            $totalPeople += $peopleOnLevel;
        }
        return $totalPeople;
    }


    /**
     * Add rooms
     *
     * @param \BubbleDiagramBundle\Entity\Room $rooms
     * @return Building
     */
    public function addRoom(\BubbleDiagramBundle\Entity\Room $rooms)
    {
        $this->rooms[] = $rooms;

        return $this;
    }

    /**
     * Remove rooms
     *
     * @param \BubbleDiagramBundle\Entity\Room $rooms
     */
    public function removeRoom(\BubbleDiagramBundle\Entity\Room $rooms)
    {
        $this->rooms->removeElement($rooms);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRooms()
    {
        return $this->rooms;
    }
}
