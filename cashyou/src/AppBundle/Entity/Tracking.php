<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrackingRepository")
 * @ORM\Table(name="tracking")
 */
class Tracking
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=256)
     */
    private $subId;

    /**
     * @var TrackingStatus
     * 
     * @ORM\Column(type="tracking_status", length=128)
     */
    private $status;

    /**
     * @var \DateTime $created
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSubId()
    {
        return $this->subId;
    }

    /**
     * @param string $subId
     */
    public function setSubId($subId)
    {
        $this->subId = $subId;
    }

    /**
     * @return TrackingStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param TrackingStatus $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}