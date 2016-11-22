<?php

namespace BubbleDiagramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use BubbleDiagramBundle\Entity\User;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="BubbleDiagramBundle\Repository\TeamRepository")
 */
class Team
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
     *
     * @ORM\OneToOne(targetEntity="Building", mappedBy="team")
     */
    private $building;
    
    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="teams")
     */
    private $users;
    
    
    public function __construct() {
        $this->users = new ArrayCollection();
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
     * Add users
     *
     * @param \BubbleDiagramBundle\Entity\User $users
     * @return Team
     */
    public function addUser(\BubbleDiagramBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \BubbleDiagramBundle\Entity\User $users
     */
    public function removeUser(\BubbleDiagramBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set building
     *
     * @param \BubbleDiagramBundle\Entity\Building $building
     * @return Team
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