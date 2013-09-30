<?php

// src/Nms/AdminBundle/Entity/Group.php
/**
 * Description of Group
 *
 * @author ptaylor
 */

namespace Nms\AdminBundle\Entity;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="Nms\AdminBundle\Entity\GroupRepository")
* @ORM\HasLifecycleCallbacks
*/
class Group implements RoleInterface {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")

     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(name="role", type="string", length=20, unique=true)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="groups")
     */
    private $users;

       /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedValue() {
        $this->setUpdated(new \DateTime());
    }

    public function __construct() {
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
        $this->users = new ArrayCollection();
    }

// ... getters and setters for each property
    /**
     * @see RoleInterface
     */
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($value) {
        $this->name = trim($value);
        return;
    }

    public function getRole() {
        return $this->role;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Group
     */
    public function setRole($role) {
        $this->role = $role;

        return $this;
    }

    /**
     * Add users
     *
     * @param \Nms\AdminBundle\Entity\User $users
     * @return Group
     */
    public function addUser(\Nms\AdminBundle\Entity\User $users) {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Nms\AdminBundle\Entity\User $users
     */
    public function removeUser(\Nms\AdminBundle\Entity\User $users) {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers() {
        return $this->users;
    }

        /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     */
    public function setCreated($created) {
        $this->created = $created;
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated() {
        return $this->updated;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Blog
     */
    public function setUpdated($updated) {
        $this->updated = $updated;
        return $this;
    }

    public function __toString() {
        return $this->name;
    }

}