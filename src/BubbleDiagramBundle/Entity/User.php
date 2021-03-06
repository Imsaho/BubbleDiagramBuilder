<?php

namespace BubbleDiagramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use BubbleDiagramBundle\Entity\Team;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="BubbleDiagramBundle\Repository\UserRepository")
 */
class User extends BaseUser {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Team", mappedBy="users", fetch="EAGER")
     * 
     */
    private $teams;

    public function __construct() {
        parent:: __construct();
        $this->teams = new ArrayCollection();
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
     * Add teams
     *
     * @param \BubbleDiagramBundle\Entity\Team $teams
     * @return User
     */
    public function addTeam(\BubbleDiagramBundle\Entity\Team $teams) {
        $this->teams[] = $teams;

        return $this;
    }

    /**
     * Remove teams
     *
     * @param \BubbleDiagramBundle\Entity\Team $teams
     */
    public function removeTeam(\BubbleDiagramBundle\Entity\Team $teams) {
        $this->teams->removeElement($teams);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeams() {
        return $this->teams;
    }

    public function __toString() {
        return $this->email;
    }

}
