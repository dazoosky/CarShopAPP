<?php

namespace WorkshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkOrderCategories
 *
 * @ORM\Table(name="work_order_categories")
 * @ORM\Entity(repositoryClass="WorkshopBundle\Repository\WorkOrderCategoriesRepository")
 */
class WorkOrderCategories
{
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
     * @ORM\Column(name="namePL", type="string", length=255)
     */
    private $namePL;

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
     * @return WorkOrderCategories
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

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set namePL
     *
     * @param string $namePL
     * @return WorkOrderCategories
     */
    public function setNamePL($namePL)
    {
        $this->namePL = $namePL;

        return $this;
    }

    /**
     * Get namePL
     *
     * @return string 
     */
    public function getNamePL()
    {
        return $this->namePL;
    }
}
