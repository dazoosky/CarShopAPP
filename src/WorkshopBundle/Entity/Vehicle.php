<?php

namespace WorkshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicle
 *
 * @ORM\Table(name="vehicle")
 * @ORM\Entity(repositoryClass="WorkshopBundle\Repository\VehicleRepository")
 */
class Vehicle {

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="vehicles")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", nullable=false)
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity="WorkOrder", mappedBy="vehicleId")
     */
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity="GasTypes")
     * @ORM\JoinColumn(name="gasType", referencedColumnName="id", nullable=false    )
     */
    private $fuel;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="make", type="string", length=100)
     */
    private $make;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var int
     *
     * @ORM\Column(name="engineCapacity", type="integer")
     */
    private $engineCapacity;



    /**
     * @var string
     *
     * @ORM\Column(name="engineCode", type="string", length=15, nullable=true)
     */
    private $engineCode;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="string", length=15, nullable=true)
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insuranceDate", type="datetime", nullable=true)
     */
    private $insuranceDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="survayDate", type="datetime", nullable=true)
     */
    private $survayDate;

    /**
     * @var string
     *
     * @ORM\Column(name="vin", type="string", length=20)
     */
    private $vin;

    /**
     * @var string
     *
     * @ORM\Column(name="plateNo", type="string", length=10)
     */
    private $plateNo;


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
     * Set type
     *
     * @param string $type
     * @return Vehicle
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set make
     *
     * @param string $make
     * @return Vehicle
     */
    public function setMake($make)
    {
        $this->make = $make;

        return $this;
    }

    /**
     * Get make
     *
     * @return string 
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return Vehicle
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Vehicle
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set engineCapacity
     *
     * @param integer $engineCapacity
     * @return Vehicle
     */
    public function setEngineCapacity($engineCapacity)
    {
        $this->engineCapacity = $engineCapacity;

        return $this;
    }

    /**
     * Get engineCapacity
     *
     * @return integer 
     */
    public function getEngineCapacity()
    {
        return $this->engineCapacity;
    }

    /**
     * Set fuel
     *
     * @param string $fuel
     * @return Vehicle
     */
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;

        return $this;
    }

    /**
     * Get fuel
     *
     * @return string 
     */
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Set engineCode
     *
     * @param string $engineCode
     * @return Vehicle
     */
    public function setEngineCode($engineCode)
    {
        $this->engineCode = $engineCode;

        return $this;
    }

    /**
     * Get engineCode
     *
     * @return string 
     */
    public function getEngineCode()
    {
        return $this->engineCode;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Vehicle
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set insuranceDate
     *
     * @param \DateTime $insuranceDate
     * @return Vehicle
     */
    public function setInsuranceDate($insuranceDate)
    {
        $this->insuranceDate = $insuranceDate;

        return $this;
    }

    /**
     * Get insuranceDate
     *
     * @return \DateTime 
     */
    public function getInsuranceDate()
    {
        return $this->insuranceDate;
    }

    /**
     * Set survayDate
     *
     * @param \DateTime $survayDate
     * @return Vehicle
     */
    public function setSurvayDate($survayDate)
    {
        $this->survayDate = $survayDate;

        return $this;
    }

    /**
     * Get survayDate
     *
     * @return \DateTime 
     */
    public function getSurvayDate()
    {
        return $this->survayDate;
    }

    /**
     * Set vin
     *
     * @param string $vin
     * @return Vehicle
     */
    public function setvin($vin)
    {
        $this->vin = $vin;

        return $this;
    }

    /**
     * Get vin
     *
     * @return string 
     */
    public function getvin()
    {
        return $this->vin;
    }

    /**
     * Set plateNo
     *
     * @param string $plateNo
     * @return Vehicle
     */
    public function setPlateNo($plateNo)
    {
        $this->plateNo = $plateNo;

        return $this;
    }

    /**
     * Get plateNo
     *
     * @return string 
     */
    public function getPlateNo()
    {
        return $this->plateNo;
    }

    /**
     * Set owner
     *
     * @param \WorkshopBundle\Entity\Person $owner
     * @return Vehicle
     */
    public function setOwner(\WorkshopBundle\Entity\Person $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \WorkshopBundle\Entity\Person 
     */
    public function getOwner()
    {
        return $this->owner;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->order = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add order
     *
     * @param \WorkshopBundle\Entity\WorkOrder $order
     * @return Vehicle
     */
    public function addOrder(\WorkshopBundle\Entity\WorkOrder $order)
    {
        $this->order[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \WorkshopBundle\Entity\WorkOrder $order
     */
    public function removeOrder(\WorkshopBundle\Entity\WorkOrder $order)
    {
        $this->order->removeElement($order);
    }

    /**
     * Get order
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function __toString()
    {
        $vehicle = $this->plateNo.' '.$this->getMake().' '.$this->getModel();
        return $vehicle;
        // TODO: Implement __toString() method.
    }
}
