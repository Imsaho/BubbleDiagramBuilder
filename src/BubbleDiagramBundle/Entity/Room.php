<?php

namespace BubbleDiagramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="number", type="string", length=16, unique=true)
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
}
