<?php
// src/AppBundle/Entity/Record.php
namespace AppBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
  * @ORM\Entity()
  * @ORM\Table(name="record")
  */
class Record 
{
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */   
    protected $time;

    /**
     * @ORM\Column(type="decimal",scale=2)
     */   
    protected $amount;

    /**
     * @ORM\Column(type="decimal",scale=2)
     */   
    protected $laterbalance;

    /**
     * @ORM\Column(type="string")
     */   
    protected $state;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="record")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="cascade")
     */
    protected $user; 

    /**
     * @ORM\OneToOne(targetEntity="Reserve", inversedBy="record")
     * @ORM\JoinColumn(name="reserve_id", referencedColumnName="id")
     */
    protected $reserve;  


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
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Record
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set amount
     *
     * @param string $amount
     *
     * @return Record
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
     * Set laterbalance
     *
     * @param string $laterbalance
     *
     * @return Record
     */
    public function setLaterbalance($laterbalance)
    {
        $this->laterbalance = $laterbalance;

        return $this;
    }

    /**
     * Get laterbalance
     *
     * @return string
     */
    public function getLaterbalance()
    {
        return $this->laterbalance;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Record
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Record
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
     * Set reserve
     *
     * @param \AppBundle\Entity\Reserve $reserve
     *
     * @return Record
     */
    public function setReserve(\AppBundle\Entity\Reserve $reserve = null)
    {
        $this->reserve = $reserve;

        return $this;
    }

    /**
     * Get reserve
     *
     * @return \AppBundle\Entity\Reserve
     */
    public function getReserve()
    {
        return $this->reserve;
    }
}
