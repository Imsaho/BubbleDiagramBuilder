<?php

namespace BubbleDiagramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BubbleDiagramBundle\Entity\Level;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="BubbleDiagramBundle\Repository\RoomRepository")
 */
class Room
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
     * @ORM\Column(name="number", type="string", length=16, unique=false)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="area", type="float")
     */
    private $area;

    /**
     * @var float
     *
     * @ORM\Column(name="min_height", type="float", nullable=true)
     */
    private $minHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="requirements", type="string", length=255, nullable=true)
     */
    private $requirements;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="max_person_amount", type="integer", nullable=true)
     */
    private $maxPersonAmount;

    /**
     * @var bool
     *
     * @ORM\Column(name="access_control", type="boolean", nullable=true)
     */
    private $accessControl;
    
    /**
     * @ORM\ManyToOne(targetEntity="Level", inversedBy="rooms")
     * @ORM\JoinColumn(name="level_id", referencedColumnName="id")
     */
    private $level;
    
    /**
     * @ORM\ManyToOne(targetEntity="Zone", inversedBy="rooms")
     * @ORM\JoinColumn(name="zone_id", referencedColumnName="id")
     */
    private $zone;
    
    /**
     * @ORM\ManyToOne (targetEntity="Building", inversedBy="rooms")
     * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     */
    private $building;
    
    /**
     * 
     * @ORM\ManyToMany(targetEntity="Room", mappedBy="myRooms")
     */
    private $roomsWithMe;
    
    /**
     * @ORM\ManyToMany(targetEntity="Room", inversedBy="roomsWithMe")
     * @ORM\JoinTable(name="joined_rooms", 
     * joinColumns={@ORM\JoinColumn(name="room_id", referencedColumnName="id")}, 
     * inverseJoinColumns={@ORM\JoinColumn(name="joined_room_id", referencedColumnName="id")})
     */
    private $myRooms;
    
    public function __construct() {
        $this->roomsWithMe = new ArrayCollection();
        $this->myRooms = new ArrayCollection();
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
     * Set number
     *
     * @param string $number
     * @return Room
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Room
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
     * Set area
     *
     * @param float $area
     * @return Room
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return float 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set minHeight
     *
     * @param float $minHeight
     * @return Room
     */
    public function setMinHeight($minHeight)
    {
        $this->minHeight = $minHeight;

        return $this;
    }

    /**
     * Get minHeight
     *
     * @return float 
     */
    public function getMinHeight()
    {
        return $this->minHeight;
    }

    /**
     * Set requirements
     *
     * @param string $requirements
     * @return Room
     */
    public function setRequirements($requirements)
    {
        $this->requirements = $requirements;

        return $this;
    }

    /**
     * Get requirements
     *
     * @return string 
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Room
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
     * Set maxPersonAmount
     *
     * @param integer $maxPersonAmount
     * @return Room
     */
    public function setMaxPersonAmount($maxPersonAmount)
    {
        $this->maxPersonAmount = $maxPersonAmount;

        return $this;
    }

    /**
     * Get maxPersonAmount
     *
     * @return integer 
     */
    public function getMaxPersonAmount()
    {
        return $this->maxPersonAmount;
    }

    /**
     * Set accessControl
     *
     * @param boolean $accessControl
     * @return Room
     */
    public function setAccessControl($accessControl)
    {
        $this->accessControl = $accessControl;

        return $this;
    }

    /**
     * Get accessControl
     *
     * @return boolean 
     */
    public function getAccessControl()
    {
        return $this->accessControl;
    }

    /**
     * Set level
     *
     * @param \BubbleDiagramBundle\Entity\Level $level
     * @return Room
     */
    public function setLevel(\BubbleDiagramBundle\Entity\Level $level = null)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return \BubbleDiagramBundle\Entity\Level 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set zone
     *
     * @param \BubbleDiagramBundle\Entity\Zone $zone
     * @return Room
     */
    public function setZone(\BubbleDiagramBundle\Entity\Zone $zone = null)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return \BubbleDiagramBundle\Entity\Zone 
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Add roomsWithMe
     *
     * @param \BubbleDiagramBundle\Entity\Room $roomsWithMe
     * @return Room
     */
    public function addRoomsWithMe(\BubbleDiagramBundle\Entity\Room $roomsWithMe)
    {
        $this->roomsWithMe[] = $roomsWithMe;

        return $this;
    }

    /**
     * Remove roomsWithMe
     *
     * @param \BubbleDiagramBundle\Entity\Room $roomsWithMe
     */
    public function removeRoomsWithMe(\BubbleDiagramBundle\Entity\Room $roomsWithMe)
    {
        $this->roomsWithMe->removeElement($roomsWithMe);
    }

    /**
     * Get roomsWithMe
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoomsWithMe()
    {
        return $this->roomsWithMe;
    }

    /**
     * Add myRooms
     *
     * @param \BubbleDiagramBundle\Entity\Room $myRooms
     * @return Room
     */
    public function addMyRoom(\BubbleDiagramBundle\Entity\Room $myRooms)
    {
        $this->myRooms[] = $myRooms;

        return $this;
    }

    /**
     * Remove myRooms
     *
     * @param \BubbleDiagramBundle\Entity\Room $myRooms
     */
    public function removeMyRoom(\BubbleDiagramBundle\Entity\Room $myRooms)
    {
        $this->myRooms->removeElement($myRooms);
    }

    /**
     * Get myRooms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyRooms()
    {
        return $this->myRooms;
    }
    
    public function __toString() {
        return $this->name;
    }

    /**
     * Set building
     *
     * @param \BubbleDiagramBundle\Entity\Building $building
     * @return Room
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
}
