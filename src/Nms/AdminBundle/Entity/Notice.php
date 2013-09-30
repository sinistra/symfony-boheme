<?php

// file: src/Nms/AdminBundle/Entity/Notice.php

namespace Nms\AdminBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Doctrine\ORM\Mapping as ORM; // doctrine orm annotations
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="notices")
 * @ORM\Entity(repositoryClass="Nms\AdminBundle\Entity\NoticeRepository")

 */

class Notice {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * removed the at Gedmo\Slug(fields={"title"}, updatable=false, separator="_")
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
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var string $createdBy
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(type="string")
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
     * @ORM\Column(type="string")
     */
    private $updatedBy;

    public function getId() {
        return $this->id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Notice
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set publish
     *
     * @param \DateTime $publish
     * @return Notice
     */
    public function setPublish($publish) {
        $this->publish = $publish;

        return $this;
    }

    /**
     * Get publish
     *
     * @return \DateTime
     */
    public function getPublish() {
        return $this->publish;
    }

    /**
     * Set expire
     *
     * @param \DateTime $expire
     * @return Notice
     */
    public function setExpire($expire) {
        $this->expire = $expire;

        return $this;
    }

    /**
     * Get expire
     *
     * @return \DateTime
     */
    public function getExpire() {
        return $this->expire;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Notice
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    public function getCreated() {
        return $this->created;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return Notice
     */
    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedBy() {
        return $this->createdBy;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Notice
     */
    public function setUpdated($updated) {
        $this->updated = $updated;

        return $this;
    }

    public function getUpdated() {
        return $this->updated;
    }

    /**
     * Set updatedBy
     *
     * @param string $updatedBy
     * @return Notice
     */
    public function setUpdatedBy($updatedBy) {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function getUpdatedBy() {
        return $this->updatedBy;
    }

    public function isExpireValid(ExecutionContextInterface $context)
    {
        // check if the expiry date is before the publish date
        if ($this->expire < $this->publish) {
            $context->addViolationAt('expire', 'The Expiry date must not be less than the Publish date!', array(), null);
        }
    }

}