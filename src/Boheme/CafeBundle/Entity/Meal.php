<?php

// file: src/Nms/CafeBundle/Entity/Meal.php

namespace Nms\CafeBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Doctrine\ORM\Mapping as ORM; // doctrine orm annotations
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="meals")
 * @ORM\Entity(repositoryClass="Nms\CafeBundle\Entity\MealRepository")

 */

class Meal {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(length=64)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="date")
     */
    private $publish;

    /**
     * @ORM\Column(type="date")
     */
    private $expire;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Sitting", inversedBy="meals")
     */
    private $sitting;

    /**
     * @ORM\ManyToOne(targetEntity="Menugroup", inversedBy="meals")
     */
    private $menugroup;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var string $createdby
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(type="string")
     */
    private $createdby;

    /**
     * @ORM\Column(name="updated", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    /**
     * @var string $updatedby
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(type="string")
     */
    private $updatedby;


    public function isExpireValid(ExecutionContextInterface $context)
    {
        // check if the expiry date is before the publish date
        if ($this->expire < $this->publish) {
            $context->addViolationAt('expire', 'The Expiry date must not be less than the Publish date!', array(), null);
        }
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
     * @return Meal
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
     * @return Meal
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
     * Set publish
     *
     * @param \DateTime $publish
     * @return Meal
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    
        return $this;
    }

    /**
     * Get publish
     *
     * @return \DateTime 
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * Set expire
     *
     * @param \DateTime $expire
     * @return Meal
     */
    public function setExpire($expire)
    {
        $this->expire = $expire;
    
        return $this;
    }

    /**
     * Get expire
     *
     * @return \DateTime 
     */
    public function getExpire()
    {
        return $this->expire;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Meal
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Meal
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
     * Set createdby
     *
     * @param string $createdby
     * @return Meal
     */
    public function setCreatedby($createdby)
    {
        $this->createdby = $createdby;
    
        return $this;
    }

    /**
     * Get createdby
     *
     * @return string 
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Meal
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
     * Set updatedby
     *
     * @param string $updatedby
     * @return Meal
     */
    public function setUpdatedby($updatedby)
    {
        $this->updatedby = $updatedby;
    
        return $this;
    }

    /**
     * Get updatedby
     *
     * @return string 
     */
    public function getUpdatedby()
    {
        return $this->updatedby;
    }

    /**
     * Set sitting
     *
     * @param \Nms\CafeBundle\Entity\Sitting $sitting
     * @return Meal
     */
    public function setSitting(\Nms\CafeBundle\Entity\Sitting $sitting = null)
    {
        $this->sitting = $sitting;
    
        return $this;
    }

    /**
     * Get sitting
     *
     * @return \Nms\CafeBundle\Entity\Sitting 
     */
    public function getSitting()
    {
        return $this->sitting;
    }

    /**
     * Set menugroup
     *
     * @param \Nms\CafeBundle\Entity\Menugroup $menugroup
     * @return Meal
     */
    public function setMenugroup(\Nms\CafeBundle\Entity\Menugroup $menugroup = null)
    {
        $this->menugroup = $menugroup;
    
        return $this;
    }

    /**
     * Get menugroup
     *
     * @return \Nms\CafeBundle\Entity\Menugroup 
     */
    public function getMenugroup()
    {
        return $this->menugroup;
    }
}