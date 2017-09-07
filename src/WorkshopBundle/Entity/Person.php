<?php

namespace WorkshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="WorkshopBundle\Repository\PersonRepository")
 */
class Person
{
    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Vehicle", mappedBy="owner")
     */
    private $vehicles;

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=50, nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="localno", type="string", length=10)
     */
    private $localno;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=6)
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100)
     */
    private $city;

    /**
     * @var int
     *
     * @ORM\Column(name="phoneno", type="integer")
     */
    private $phoneno;

    /**
     * @var int
     *
     * @ORM\Column(name="nip", type="string", nullable=true)
     */
    private $nip;

    /**
     * @var int
     *
     * @ORM\Column(name="customer", type="integer", nullable=false, options={"default":1})
     */
    private $customer;


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
     * Set name
     *
     * @param string $name
     * @return Person
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Person
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Person
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set localno
     *
     * @param string $localno
     * @return Person
     */
    public function setLocalno($localno)
    {
        $this->localno = $localno;

        return $this;
    }

    /**
     * Get localno
     *
     * @return string 
     */
    public function getLocalno()
    {
        return $this->localno;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return Person
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Person
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set phoneno
     *
     * @param integer $phoneno
     * @return Person
     */
    public function setPhoneno($phoneno)
    {
        $this->phoneno = $phoneno;

        return $this;
    }

    /**
     * Get phoneno
     *
     * @return integer 
     */
    public function getPhoneno()
    {
        return $this->phoneno;
    }

    /**
     * Set nip
     *
     * @param integer $nip
     * @return Person
     */
    public function setNip($nip)
    {
        $this->nip = $nip;

        return $this;
    }

    /**
     * Get nip
     *
     * @return integer 
     */
    public function getNip()
    {
        return $this->nip;
    }

    /**
     * Set user
     *
     * @param \WorkshopBundle\Entity\User $user
     * @return Person
     */
    public function setUser(\WorkshopBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \WorkshopBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set customer
     *
     * @param integer $customer
     * @return Person
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return integer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set employee
     *
     * @param integer $employee
     * @return Person
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * Get employee
     *
     * @return integer 
     */
    public function getEmployee()
    {
        return $this->employee;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vehicles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add vehicles
     *
     * @param \WorkshopBundle\Entity\Vehicle $vehicles
     * @return Person
     */
    public function addVehicle(\WorkshopBundle\Entity\Vehicle $vehicles)
    {
        $this->vehicles[] = $vehicles;

        return $this;
    }

    /**
     * Remove vehicles
     *
     * @param \WorkshopBundle\Entity\Vehicle $vehicles
     */
    public function removeVehicle(\WorkshopBundle\Entity\Vehicle $vehicles)
    {
        $this->vehicles->removeElement($vehicles);
    }

    /**
     * Get vehicles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }

    public function __toString() {
        $name = $this->surname.' '.$this->name;
        return $name;
    }
}
