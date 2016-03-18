<?php
namespace Acme\Bundle\BlogBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;


/**
  * @ORM\Entity
  * @ORM\Table(name="cour")
  */
class Cour 
{
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
    * @ORM\Column(type="string", length=30)
    */
    protected $title;

    /**
    * @ORM\Column(type="string", length=100)
    */
    protected $photo;

    /**
    * @ORM\Column(type="string", length=20, nullable=true)
    */
    protected $duration;

   /**
    * @ORM\Column(type="string", nullable=true)
    */
    protected $tcVideoUrl;
    
      /**
     * @ORM\Column(type="integer")
     */     
    protected $pid;

     /**
     * @ORM\Column(type="string")
     */     
    protected $path;

    /**
     * @ORM\ManyToOne(targetEntity="Classes", inversedBy="cour")
     * @ORM\JoinColumn(name="classes_id", referencedColumnName="id", onDelete="cascade")
     */
    protected $classes; 


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
     * @return Cour
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
     * @return Cour
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
     * @return Cour
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
     * @return Cour
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
     * Set pid
     *
     * @param integer $pid
     *
     * @return Cour
     */
    public function setPid($pid)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Get pid
     *
     * @return integer
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Cour
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set classes
     *
     * @param \Acme\Bundle\BlogBundle\Entity\Classes $classes
     *
     * @return Cour
     */
    public function setClasses(\Acme\Bundle\BlogBundle\Entity\Classes $classes = null)
    {
        $this->classes = $classes;

        return $this;
    }

    /**
     * Get classes
     *
     * @return \Acme\Bundle\BlogBundle\Entity\Classes
     */
    public function getClasses()
    {
        return $this->classes;
    }
}
