<?php

// src/Nms/AdminBundle/Entity/Menu.php
/**
 * Description of Menu
 *
 * @author ptaylor
 */

namespace Nms\AdminBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="menus")
 * @ORM\Entity(repositoryClass="Nms\AdminBundle\Entity\MenuRepository")
 * @ORM\HasLifecycleCallbacks

 */
class Menu {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="parent", type="integer")
     */
    private $parent;

    /**
     * @ORM\Column(name="seq", type="integer")
     */
    private $seq;

    /**
     * @ORM\Column(name="title", type="string", length=30)
     */
    private $title;
    /**
     * @ORM\Column(name="icon", type="string", length=20, nullable=true)
     */
    private $icon;

    /**
     * @ORM\Column(name="url", type="string", length=50, unique=true)
     */
    private $url;

    /**
     * @ORM\Column(name="secured", type="boolean")
     */
    private $secured;

    /**
     * @ORM\Column(name="external", type="boolean")
     */
    private $external;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $created;

    /**
     * @var string $createdBy
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(type="string", length=30)

     */
    private $createdBy;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated", type="datetime")
     */
    protected $updated;

    /**
     * @var string $updatedBy
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(type="string", length=30)
     */
    private $updatedBy;

    /**
     * @var string $role
     * @ORM\Column(type="string", length=30)
     */
    private $role;


    public function __construct() {
        $this->role = 'ROLE_USER';
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
     * Set parent
     *
     * @param integer $parent
     * @return Menu
     */
    public function setParent($parent) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set seq
     *
     * @param integer $seq
     * @return Menu
     */
    public function setSeq($seq)
    {
        $this->seq = $seq;

        return $this;
    }

    /**
     * Get seq
     *
     * @return integer
     */
    public function getSeq()
    {
        return $this->seq;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Menu
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Menu
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set secured
     *
     * @param integer $secured
     * @return Menu
     */
    public function setSecured($secured)
    {
        $this->secured = $secured;

        return $this;
    }

    /**
     * Get secured
     *
     * @return integer
     */
    public function getSecured()
    {
        return $this->secured;
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

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return Menu
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param string $updatedBy
     * @return Menu
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return string
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set external
     *
     * @param boolean $external
     * @return Menu
     */
    public function setExternal($external)
    {
        $this->external = $external;

        return $this;
    }

    /**
     * Get external
     *
     * @return boolean
     */
    public function getExternal()
    {
        return $this->external;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Menu
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set icon
     *
     * @param string $icon
     * @return Menu
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }
}