<?php
// src/AppBundle/Entity/Coupons.php
namespace AppBundle\Entity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User;

/**
  * @ORM\Entity()
  * @ORM\Table(name="coupons")
  */
class Coupons
{
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
    * @ORM\Column(type="string")
    */
    protected $amount;

    /**
    * @ORM\Column(type="string")
    */
    protected $species;

   /**
    * @ORM\Column(type="string")
    */
    protected $minmoney;

   /**
    * @ORM\Column(type="string")
    */
    protected $time;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="coupons", cascade={"persist"})
     * @ORM\JoinTable(name="user_coupons",
     * joinColumns={@ORM\JoinColumn(name="coupons_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    private $user;

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
     * Set amount
     *
     * @param string $amount
     *
     * @return Coupons
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set species
     *
     * @param string $species
     *
     * @return Coupons
     */
    public function setSpecies($species)
    {
        $this->species = $species;

        return $this;
    }

    /**
     * Get species
     *
     * @return string
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * Set minmoney
     *
     * @param string $minmoney
     *
     * @return Coupons
     */
    public function setMinmoney($minmoney)
    {
        $this->minmoney = $minmoney;

        return $this;
    }

    /**
     * Get minmoney
     *
     * @return string
     */
    public function getMinmoney()
    {
        return $this->minmoney;
    }

    /**
     * Set time
     *
     * @param string $time
     *
     * @return Coupons
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Constructor
     */
    public function __construct()
    {

        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Coupons
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;

        $this->usercoupon = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add usercoupon
     *
     * @param \AppBundle\Entity\Usercoupon $usercoupon
     *
     * @return Coupons
     */
    public function addUsercoupon(\AppBundle\Entity\Usercoupon $usercoupon)
    {
        $this->usercoupon[] = $usercoupon;
        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }
}
