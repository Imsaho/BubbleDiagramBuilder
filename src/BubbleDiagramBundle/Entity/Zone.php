<?php

namespace BubbleDiagramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Zone
 *
 * @ORM\Table(name="zone")
 * @ORM\Entity(repositoryClass="BubbleDiagramBundle\Repository\ZoneRepository")
 */
class Zone {

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
     * @ORM\Column(name="name", type="string", length=255, unique=false)
     * @Assert\NotBlank (message="Wpisz nazwę")
     * @Assert\Length (min=3, minMessage="Nazwa powinna mieć długość co najmniej 3 znaków")
     */
    private $name;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=16, unique=false)
     * @Assert\NotBlank (message="Wybierz kolor")
     * @Assert\Regex (pattern="/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/",
     *                                  message="Kolor w formacie szesnastkowym, np. #a5bf4a")
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="zones")
     * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     */
    private $building;

    /**
     * @ORM\OneToMany(targetEntity="Room", mappedBy="zone", cascade={"remove"})
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
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Zone
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
     * Set description
     *
     * @param string $description
     * @return Zone
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
     * Set color
     *
     * @param string $color
     * @return Zone
     */
    public function setColor($color) {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor() {
        return $this->color;
    }

    /**
     * Set building
     *
     * @param \BubbleDiagramBundle\Entity\Building $building
     * @return Zone
     */
    public function setBuilding(\BubbleDiagramBundle\Entity\Building $building =
    null) {
        $this->building = $building;

        return $this;
    }

    /**
     * Get building
     *
     * @return \BubbleDiagramBundle\Entity\Building 
     */
    public function getBuilding() {
        return $this->building;
    }

    /**
     * Add rooms
     *
     * @param \BubbleDiagramBundle\Entity\Room $rooms
     * @return Zone
     */
    public function addRoom(\BubbleDiagramBundle\Entity\Room $rooms) {
        $this->rooms[] = $rooms;

        return $this;
    }

    /**
     * Remove rooms
     *
     * @param \BubbleDiagramBundle\Entity\Room $rooms
     */
    public function removeRoom(\BubbleDiagramBundle\Entity\Room $rooms) {
        $this->rooms->removeElement($rooms);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRooms() {
        return $this->rooms;
    }

    public function __toString() {
        return $this->name;
    }

    public function calculateZoneNBA() {
        $zoneNBA = 0;
        foreach ($this->rooms as $room) {
            $roomArea = $room->getArea();
            $zoneNBA += $roomArea;
        }
        return $zoneNBA;
    }

    public function calculatePeopleInZone() {
        $people = 0;
        foreach ($this->rooms as $room) {
            $peopleInRoom = $room->getMaxPersonAmount();
            $people += $peopleInRoom;
        }
        return $people;
    }

}