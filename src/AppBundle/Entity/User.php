<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\AttributeOverrides({
 *     @ORM\AttributeOverride(name="email",
 *          column=@ORM\Column(
 *              nullable = true,
 *              unique= false
 *          )
 *      ),
 *     @ORM\AttributeOverride(name="emailCanonical",
 *          column=@ORM\Column(
 *              name = "email_canonical",
 *              nullable = true,
 *              unique= false
 *          ) 
 *      )
 * })
 */


class User extends BaseUser
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // $account = new Account();
        // $coin = new Coin();

        // $this->setAccount( $account );
        // $this->setCoin( $coin );
        // your own logic
    }

   /**
    * @ORM\Column(type="string", length=20)
    */
    protected $mobile = '';


    /**
     * @ORM\OneToOne(targetEntity="Account", mappedBy="user")
     */
    protected $account;

    /**
     * @ORM\OneToMany(targetEntity="Reserve", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $reserve;

     /**
     * @ORM\OneToMany(targetEntity="Record", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $record;

    /**
     * Set mobile
     *
     * @param integer $mobile
     *
     * @return Category
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return integer
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    

    /**
     * Set account
     *
     * @param \AppBundle\Entity\Account $account
     *
     * @return User
     */
    public function setAccount(\AppBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \AppBundle\Entity\Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Add reserve
     *
     * @param \AppBundle\Entity\Reserve $reserve
     *
     * @return User
     */
    public function addReserve(\AppBundle\Entity\Reserve $reserve)
    {
        $this->reserve[] = $reserve;

        return $this;
    }

    /**
     * Remove reserve
     *
     * @param \AppBundle\Entity\Reserve $reserve
     */
    public function removeReserve(\AppBundle\Entity\Reserve $reserve)
    {
        $this->reserve->removeElement($reserve);
    }

    /**
     * Get reserve
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReserve()
    {
        return $this->reserve;
    }

    /**
     * Add record
     *
     * @param \AppBundle\Entity\Record $record
     *
     * @return User
     */
    public function addRecord(\AppBundle\Entity\Record $record)
    {
        $this->record[] = $record;

        return $this;
    }

    /**
     * Remove record
     *
     * @param \AppBundle\Entity\Record $record
     */
    public function removeRecord(\AppBundle\Entity\Record $record)
    {
        $this->record->removeElement($record);
    }

    /**
     * Get record
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRecord()
    {
        return $this->record;
    }
}
