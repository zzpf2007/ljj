<?php
namespace AppBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\BaseModel;
//use Acme\Bundle\MobileBundle\Entity;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\User;

/**
  * @ORM\Entity
  * @ORM\Table(name="course")
  */
class Course extends BaseModel
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
      * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="courses")
      * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id")
      */
    protected $teacher;

      /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="course", cascade={"persist"})
     * @ORM\JoinTable(name="user_course",
     * joinColumns={@ORM\JoinColumn(name="course_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="course")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", onDelete="cascade")
     */
    protected $type; 

    /**
     * @ORM\OneToMany(targetEntity="Course", mappedBy="item", cascade={"persist", "remove"})
     */
    protected $item;

    private $isSave;

    public function __construct() {
        parent::__construct();
        $this->isSave = false;
        $this->title = 'empty';
        $this->photo = 'empty';
        $this->duration = '0:0:0';
    }
    public function getSave()
    {
        return $this->isSave;
    }
    public function setSave()
    {
        $this->isSave = true;
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
     * Set teacher
     *
     * @param \AppBUndle\Entity\Teacher $teacher
     *
     * @return Course
     */
    public function setTeacher(Teacher $teacher = null)

    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \Acme\Bundle\MobileBundle\Entity\Teacher
     */
    public function getTeacher()
    {
        return $this->teacher;
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
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Course
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;

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


    /**
     * Set type
     *
     * @param \AppBundle\Entity\Type $type
     *
     * @return Course
     */
    public function setType(\AppBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add item
     *
     * @param \AppBundle\Entity\Course $item
     *
     * @return Course
     */
    public function addItem(\AppBundle\Entity\Course $item)
    {
        $this->item[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \AppBundle\Entity\Course $item
     */
    public function removeItem(\AppBundle\Entity\Course $item)
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
}
