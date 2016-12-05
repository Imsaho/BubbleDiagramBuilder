<?php

namespace BubbleDiagramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use BubbleDiagramBundle\Entity\Room;

/**
 * Level
 *
 * @ORM\Table(name="level")
 * @ORM\Entity(repositoryClass="BubbleDiagramBundle\Repository\LevelRepository")
 */
class Level
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
     * @ORM\Column(name="name", type="string", length=12, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=16, unique=false)
     */
    private $color;
    
    /**
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="levels")
     * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     */
    private $building;
    
    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="level")
     */
    private $rooms;

    public function __construct() {
        $this->rooms = new ArrayCollection();
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
     * @return Level
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
     * Set description
     *
     * @param string $description
     * @return Level
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
     * Set color
     *
     * @param string $color
     * @return Level
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set building
     *
     * @param \BubbleDiagramBundle\Entity\Building $building
     * @return Level
     */
    public function setBuilding(\BubbleDiagramBundle\Entity\Building $building = null)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get building
     *
     * @return \BubbleDiagramBundle\Entity\Building 
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Add rooms
     *
     * @param \BubbleDiagramBundle\Entity\Room $rooms
     * @return Level
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
    
    public function __toString() {
        return $this->name;
    }
    
    public function calculateLevelNBA() {
        $levelNBA = 0;
        foreach ($this->rooms as $room) {
            $roomArea = $room->getArea();
            $levelNBA += $roomArea;
        }
        return $levelNBA;
    }
    
    public function calculatePeopleOnLevel() {
        $people = 0;
        foreach ($this->rooms as $room) {
            $peopleInRoom = $room->getMaxPersonAmount();
            $people += $peopleInRoom;
        }
        return $people;
    }
}
