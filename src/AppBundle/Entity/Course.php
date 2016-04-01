<?php
namespace AppBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
  * @ORM\Entity() 
  * @ORM\Table(name="course")
  */
class Course
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
     * @ORM\Column(type="string")
     */   
    protected $photo;

    /**
    * @ORM\Column(type="string")
    */

    protected $duration;

   /**
    * @ORM\Column(type="string", nullable=true)
    */
    protected $tcVideoUrl;

     /**
      * @ORM\ManyToOne(targetEntity="Subcategory", inversedBy="course")
      * @ORM\JoinColumn(name="subcategory_id", referencedColumnName="id")
      */
    protected $subcategory;

     /**
      * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="course")
      * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id")
      */
    protected $teacher;

    /**
    * @ORM\OneToMany(targetEntity="Item", mappedBy="course")
    */
    protected $item;

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
     * @return Course
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
     * Set photo
     *
     * @param string $photo
     *
     * @return Course
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
     * Set duration
     *
     * @param string $duration
     *
     * @return Course
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set tcVideoUrl
     *
     * @param string $tcVideoUrl
     *
     * @return Course
     */
    public function setTcVideoUrl($tcVideoUrl)
    {
        $this->tcVideoUrl = $tcVideoUrl;

        return $this;
    }

    /**
     * Get tcVideoUrl
     *
     * @return string
     */
    public function getTcVideoUrl()
    {
        return $this->tcVideoUrl;
    }

    /**
     * Set teacher
     *
     * @param \AppBundle\Entity\Teacher $teacher
     *
     * @return Course
     */
    public function setTeacher(\AppBundle\Entity\Teacher $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \AppBundle\Entity\Teacher
     */
    public function getTeacher()
    {
        return $this->teacher;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->item = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add item
     *
     * @param \AppBundle\Entity\Item $item
     *
     * @return Course
     */
    public function addItem(\AppBundle\Entity\Item $item)
    {
        $this->item[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \AppBundle\Entity\Item $item
     */
    public function removeItem(\AppBundle\Entity\Item $item)
    {
        $this->item->removeElement($item);
    }

    /**
     * Get item
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set subcategory
     *
     * @param \AppBundle\Entity\Subcategory $subcategory
     *
     * @return Course
     */
    public function setSubcategory(\AppBundle\Entity\Subcategory $subcategory = null)
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    /**
     * Get subcategory
     *
     * @return \AppBundle\Entity\Subcategory
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }
}
