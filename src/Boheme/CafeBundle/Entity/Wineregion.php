<?php
// file: src/Boheme/CafeBundle/Entity/Wineregion.php

namespace Boheme\CafeBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Doctrine\ORM\Mapping as ORM; // doctrine orm annotations
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="Boheme\CafeBundle\Entity\WineregionRepository")
 * @ORM\Table(name="wineregions")
 */

class Wineregion {

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
     * @ORM\OneToMany(targetEntity="Wine", mappedBy="region")
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
        $this->wines = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Wineregion
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
     * Set content
     *
     * @param string $content
     * @return Wineregion
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
     * Set created
     *
     * @param \DateTime $created
     * @return Wineregion
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
     * @return Wineregion
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
     * @return Wineregion
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
     * @return Wineregion
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
     * Add wines
     *
     * @param \Boheme\CafeBundle\Entity\Wine $wines
     * @return Wineregion
     */
    public function addWine(\Boheme\CafeBundle\Entity\Wine $wines)
    {
        $this->wines[] = $wines;

        return $this;
    }

    /**
     * Remove wines
     *
     * @param \Boheme\CafeBundle\Entity\Wine $wines
     */
    public function removeWine(\Boheme\CafeBundle\Entity\Wine $wines)
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

    /**
     * toString
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function __toString()
    {
        return $this->title;
    }
}