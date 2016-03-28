<?php
// src/AppBundle/Entity/Account.php
namespace AppBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User;

/**
  * @ORM\Entity()
  * @ORM\Table(name="account_info")
  */
class Account 
{
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
    * @ORM\Column(type="text")
    */
    protected $photo;

    /**
    * @ORM\Column(type="string")
    */
    protected $name;

    /**
    * @ORM\Column(type="string" )
    */
    protected $phonenumber;

    /**
    * @ORM\Column(type="string" )
    */
    protected $othernumber;

    /**
    * @ORM\Column(type="string" )
    */
    protected $signature;

    /**
    * @ORM\Column(type="integer")
    */
    protected $signin;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="account")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;   
    
    public function __construct()
    {
        $this->name = 'lily';
        $this->photo = 'http://img4.imgtn.bdimg.com/it/u=172112303,3232882607&fm=21&gp=0.jpg';
        $this->signin = 0;
        $this->phonenumber = 0;
        $this->othernumber = 0;
        $this->signature = '';
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
     * Set photo
     *
     * @param string $photo
     *
     * @return Account
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }


    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Account
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
     * Set phonenumber
     *
     * @param string $phonenumber
     *
     * @return Account
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }


    /**
     * Get phonenumber
     *
     * @return string
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }


    /**
     * Set othernumber
     *
     * @param string $othernumber
     *
     * @return Account
     */
    public function setOthernumber($othernumber)
    {
        $this->othernumber = $othernumber;

        return $this;
    }


    /**
     * Get othernumber
     *
     * @return string
     */
    public function getOthernumber()
    {
        return $this->othernumber;
    }


    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Account
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }


    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * Set signin
     *
     * @param integer $signin
     *
     * @return Account
     */
    public function setSignin($signin)
    {
        $this->signin = $signin;
        return $this;
    }


    /**
     * Get signin
     *
     * @return integer
     */
    public function getSignin()
    {
        return $this->signin;
    }


    /**
     * Set signature
     *
     * @param string $signature
     *
     * @return Account
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;
        return $this;
    }


    /**
     * Get signature
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }
}
