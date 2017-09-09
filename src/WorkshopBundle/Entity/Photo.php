<?php

namespace WorkshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="WorkshopBundle\Repository\PhotoRepository")
 */
class Photo
{
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="WorkOrder", inversedBy="photos")
     * @ORM\JoinColumn(name="workorder_id", referencedColumnName="id")
     */
    private $workorder;

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
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


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
     * @return Photo
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
     * Set author
     *
     * @param \WorkshopBundle\Entity\User $author
     * @return Photo
     */
    public function setAuthor(\WorkshopBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \WorkshopBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set workorder
     *
     * @param \WorkshopBundle\Entity\WorkOrder $workorder
     * @return Photo
     */
    public function setWorkorder(\WorkshopBundle\Entity\WorkOrder $workorder = null)
    {
        $this->workorder = $workorder;

        return $this;
    }

    /**
     * Get workorder
     *
     * @return \WorkshopBundle\Entity\WorkOrder 
     */
    public function getWorkorder()
    {
        return $this->workorder;
    }
}
