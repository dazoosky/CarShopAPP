<?php
namespace WorkshopBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="FOS_Users")
*/
class User extends BaseUser{

    /**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;
	
        public function __construct() {
		parent::__construct();
        $this->roles = array('ROLE_CUSTOMER');
        }
        
   

    /**
     * Set person
     *
     * @param \WorkshopBundle\Entity\Person $person
     * @return User
     */
    public function setPerson(\WorkshopBundle\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \WorkshopBundle\Entity\Person 
     */
    public function getPerson()
    {
        return $this->person;
    }
}
