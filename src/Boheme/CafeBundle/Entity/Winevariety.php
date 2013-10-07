<?php
// file: src/Boheme/CafeBundle/Entity/Winevariety.php

namespace Boheme\CafeBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Doctrine\ORM\Mapping as ORM; // doctrine orm annotations
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="Boheme\CafeBundle\Entity\WinevarietyRepository")
 * @ORM\Table(name="winevarieties")
 */

class Winevariety {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(length=64, type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity="Wine", mappedBy="variety")
     */
    private $wines;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var string $createdBy
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(length=25, type="string")
     */
    private $createdBy;

    /**
     * @ORM\Column(name="updated", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    /**
     * @var string $updatedBy
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(length=25, type="string")
     */
    private $updatedBy;

    public function isExpireValid(ExecutionContextInterface $context)
    {
        // check if the expiry date is before the publish date
        if ($this->expire < $this->publish) {
            $context->addViolationAt('expire', 'The Expiry date must not be less than the Publish date!', array(), null);
        }
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set role
     *
     * @param string $role
     * @return Volunteer
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
     * Set expiry
     *
     * @param \DateTime $expiry
     * @return Volunteer
     */
    public function setExpiry($expiry)
    {
        $this->expiry = $expiry;

        return $this;
    }

    /**
     * Get expiry
     *
     * @return \DateTime
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Volunteer
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return Volunteer
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Volunteer
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set updatedBy
     *
     * @param string $updatedBy
     * @return Volunteer
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
     * Add members
     *
     * @param \Nms\ClubBundle\Entity\Member $members
     * @return Volunteer
     */
    public function addMember(\Nms\ClubBundle\Entity\Member $members)
    {
        $this->members[] = $members;

        return $this;
    }

    /**
     * Remove members
     *
     * @param \Nms\ClubBundle\Entity\Member $members
     */
    public function removeMember(\Nms\ClubBundle\Entity\Member $members)
    {
        $this->members->removeElement($members);
    }

    /**
     * Get members
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Clubrole
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
     * Set club
     *
     * @param \Nms\ClubBundle\Entity\Club $club
     * @return Clubrole
     */
    public function setClub(\Nms\ClubBundle\Entity\Club $club = null)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return \Nms\ClubBundle\Entity\Club
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Add committeemembers
     *
     * @param \Nms\ClubBundle\Entity\Committeemember $committeemembers
     * @return Clubrole
     */
    public function addCommitteemember(\Nms\ClubBundle\Entity\Committeemember $committeemembers)
    {
        $this->committeemembers[] = $committeemembers;

        return $this;
    }

    /**
     * Remove committeemembers
     *
     * @param \Nms\ClubBundle\Entity\Committeemember $committeemembers
     */
    public function removeCommitteemember(\Nms\ClubBundle\Entity\Committeemember $committeemembers)
    {
        $this->committeemembers->removeElement($committeemembers);
    }

    /**
     * Get committeemembers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommitteemembers()
    {
        return $this->committeemembers;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Clubrole
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Winevariety
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Add wines
     *
     * @param \Nms\CafeBundle\Entity\Wine $wines
     * @return Winevariety
     */
    public function addWine(\Nms\CafeBundle\Entity\Wine $wines)
    {
        $this->wines[] = $wines;

        return $this;
    }

    /**
     * Remove wines
     *
     * @param \Nms\CafeBundle\Entity\Wine $wines
     */
    public function removeWine(\Nms\CafeBundle\Entity\Wine $wines)
    {
        $this->wines->removeElement($wines);
    }

    /**
     * Get wines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWines()
    {
        return $this->wines;
    }
}