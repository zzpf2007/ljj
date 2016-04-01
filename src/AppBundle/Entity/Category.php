<?php
namespace AppBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
  * @ORM\Entity() 
  * @ORM\Table(name="category")
  */
class Category
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
    protected $title;

     /**
    * @ORM\OneToMany(targetEntity="Subcategory", mappedBy="category")
    */
    protected $subcategory;

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
     * Set title
     *
     * @param string $title
     *
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->course = new \Doctrine\Common\Collections\ArrayCollection();
    } 

    /**
     * Add subcategory
     *
     * @param \AppBundle\Entity\Subcategory $subcategory
     *
     * @return Category
     */
    public function addSubcategory(\AppBundle\Entity\Subcategory $subcategory)
    {
        $this->subcategory[] = $subcategory;

        return $this;
    }

    /**
     * Remove subcategory
     *
     * @param \AppBundle\Entity\Subcategory $subcategory
     */
    public function removeSubcategory(\AppBundle\Entity\Subcategory $subcategory)
    {
        $this->subcategory->removeElement($subcategory);
    }

    /**
     * Get subcategory
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }
}
