<?php

namespace WorkshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkOrder
 *
 * @ORM\Table(name="work_order")
 * @ORM\Entity(repositoryClass="WorkshopBundle\Repository\WorkOrderRepository")
 */
class WorkOrder
{
    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="workorder")
     * @ORM\JoinColumn(name="photo_id", referencedColumnName="id")
     */
    private $photos;

    /**
     * @ORM\ManyToOne(targetEntity="Vehicle", inversedBy="order")
     * @ORM\JoinColumn(name="vehicle_id", referencedColumnName="id", nullable=false)
     */
    private $vehicleId;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="OrderStatus")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", nullable=false)
     */
    private $status;

    /**
     * @var array
     *
     * @ORM\Column(name="toDo", type="array")
     */
    private $toDo;

    /**
     * @var array
     *
     * @ORM\Column(name="parts", type="array")
     */
    private $parts;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startTime", type="datetime")
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endTime", type="datetime")
     */
    private $endTime;

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;


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
     * Set toDo
     *
     * @param array $toDo
     * @return WorkOrder
     */
    public function setToDo($toDo)
    {
        $this->toDo = $toDo;

        return $this;
    }

    /**
     * Get toDo
     *
     * @return array 
     */
    public function getToDo()
    {
        return $this->toDo;
    }

    /**
     * Set parts
     *
     * @param array $parts
     * @return WorkOrder
     */
    public function setParts($parts)
    {
        $this->parts = $parts;

        return $this;
    }

    /**
     * Get parts
     *
     * @return array 
     */
    public function getParts()
    {
        return $this->parts;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return WorkOrder
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     * @return WorkOrder
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return WorkOrder
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return WorkOrder
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return WorkOrder
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set vehicleId
     *
     * @param \WorkshopBundle\Entity\Vehicle $vehicleId
     * @return WorkOrder
     */
    public function setVehicleId(\WorkshopBundle\Entity\Vehicle $vehicleId)
    {
        $this->vehicleId = $vehicleId;

        return $this;
    }

    /**
     * Get vehicleId
     *
     * @return \WorkshopBundle\Entity\Vehicle 
     */
    public function getVehicleId()
    {
        return $this->vehicleId;
    }

    public function setPhotos($photos) {
        return $this->photos = $photos;
    }
    public function getPhotos() {
        return $this->photos;
    }

    public function __construct()
    {
        $this->setStartTime(new \DateTime());
        $this->setEndTime(new \DateTime());
        return $this;
    }

    public function __toString()
    {
        return strval($this->id);
    }
}
