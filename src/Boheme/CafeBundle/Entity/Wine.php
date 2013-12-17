<?php

// file: src/Boheme/CafeBundle/Entity/Wine.php

namespace Boheme\CafeBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Doctrine\ORM\Mapping as ORM; // doctrine orm annotations
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="wines")
 * @ORM\Entity(repositoryClass="Boheme\CafeBundle\Entity\WineRepository")

 */

class Wine {

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
    private $note;

    /**
     * @ORM\Column(type="integer")
     */
    private $glassvolume = 0;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $glassprice = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $carafevolume = 0;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $carafeprice = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $bottlevolume = 0;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $bottleprice = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Winevariety", inversedBy="wines")
     */
    private $variety;

    /**
     * @ORM\ManyToOne(targetEntity="Wineregion", inversedBy="wines")
     */
    private $region;

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
     * @return Wine
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
     * Set note
     *
     * @param string $note
     * @return Wine
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set glassvolume
     *
     * @param integer $glassvolume
     * @return Wine
     */
    public function setGlassvolume($glassvolume)
    {
        $this->glassvolume = $glassvolume;

        return $this;
    }

    /**
     * Get glassvolume
     *
     * @return integer
     */
    public function getGlassvolume()
    {
        return $this->glassvolume;
    }

    /**
     * Set glassprice
     *
     * @param float $glassprice
     * @return Wine
     */
    public function setGlassprice($glassprice)
    {
        $this->glassprice = $glassprice;

        return $this;
    }

    /**
     * Get glassprice
     *
     * @return float
     */
    public function getGlassprice()
    {
        return $this->glassprice;
    }

    /**
     * Set carafevolume
     *
     * @param integer $carafevolume
     * @return Wine
     */
    public function setCarafevolume($carafevolume)
    {
        $this->carafevolume = $carafevolume;

        return $this;
    }

    /**
     * Get carafevolume
     *
     * @return integer
     */
    public function getCarafevolume()
    {
        return $this->carafevolume;
    }

    /**
     * Set carafeprice
     *
     * @param float $carafeprice
     * @return Wine
     */
    public function setCarafeprice($carafeprice)
    {
        $this->carafeprice = $carafeprice;

        return $this;
    }

    /**
     * Get carafeprice
     *
     * @return float
     */
    public function getCarafeprice()
    {
        return $this->carafeprice;
    }

    /**
     * Set bottlevolume
     *
     * @param integer $bottlevolume
     * @return Wine
     */
    public function setBottlevolume($bottlevolume)
    {
        $this->bottlevolume = $bottlevolume;

        return $this;
    }

    /**
     * Get bottlevolume
     *
     * @return integer
     */
    public function getBottlevolume()
    {
        return $this->bottlevolume;
    }

    /**
     * Set bottleprice
     *
     * @param float $bottleprice
     * @return Wine
     */
    public function setBottleprice($bottleprice)
    {
        $this->bottleprice = $bottleprice;

        return $this;
    }

    /**
     * Get bottleprice
     *
     * @return float
     */
    public function getBottleprice()
    {
        return $this->bottleprice;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Wine
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
     * @return Wine
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
     * @return Wine
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
     * @return Wine
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
     * Set variety
     *
     * @param \Nms\CafeBundle\Entity\Winevariety $variety
     * @return Wine
     */
    public function setVariety(\Boheme\CafeBundle\Entity\Winevariety $variety = null)
    {
        $this->variety = $variety;

        return $this;
    }

    /**
     * Get variety
     *
     * @return \Boheme\CafeBundle\Entity\Winevariety
     */
    public function getVariety()
    {
        return $this->variety;
    }

    /**
     * Set region
     *
     * @param \Boheme\CafeBundle\Entity\Wineregion $region
     * @return Wine
     */
    public function setRegion(\Boheme\CafeBundle\Entity\Wineregion $region = null)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Boheme\CafeBundle\Entity\Wineregion
     */
    public function getRegion()
    {
        return $this->region;
    }
}