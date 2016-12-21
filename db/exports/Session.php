<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Session
 *
 * @ORM\Entity()
 * @ORM\Table(name="`session`", indexes={@ORM\Index(name="fk_session_course1_idx", columns={"course_id"})})
 */
class Session
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $detail;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdat;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $finishedat;

    /**
     * @ORM\Column(name="`order`", type="boolean")
     */
    protected $order;

    /**
     * @ORM\Column(type="integer")
     */
    protected $course_id;

    /**
     * @ORM\OneToMany(targetEntity="Multiplechoice", mappedBy="session")
     * @ORM\JoinColumn(name="id", referencedColumnName="session_id", nullable=false)
     */
    protected $multiplechoices;

    /**
     * @ORM\OneToMany(targetEntity="Shortanswer", mappedBy="session")
     * @ORM\JoinColumn(name="id", referencedColumnName="session_id", nullable=false)
     */
    protected $shortanswers;

    /**
     * @ORM\OneToMany(targetEntity="Trueorfalse", mappedBy="session")
     * @ORM\JoinColumn(name="id", referencedColumnName="session_id", nullable=false)
     */
    protected $trueorfalses;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="sessions")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id", nullable=false)
     */
    protected $course;

    public function __construct()
    {
        $this->multiplechoices = new ArrayCollection();
        $this->shortanswers = new ArrayCollection();
        $this->trueorfalses = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Session
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of title.
     *
     * @param string $title
     * @return \CoreBundle\Entity\Session
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of detail.
     *
     * @param string $detail
     * @return \CoreBundle\Entity\Session
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get the value of detail.
     *
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set the value of createdat.
     *
     * @param \DateTime $createdat
     * @return \CoreBundle\Entity\Session
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get the value of createdat.
     *
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set the value of finishedat.
     *
     * @param \DateTime $finishedat
     * @return \CoreBundle\Entity\Session
     */
    public function setFinishedat($finishedat)
    {
        $this->finishedat = $finishedat;

        return $this;
    }

    /**
     * Get the value of finishedat.
     *
     * @return \DateTime
     */
    public function getFinishedat()
    {
        return $this->finishedat;
    }

    /**
     * Set the value of order.
     *
     * @param boolean $order
     * @return \CoreBundle\Entity\Session
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get the value of order.
     *
     * @return boolean
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set the value of course_id.
     *
     * @param integer $course_id
     * @return \CoreBundle\Entity\Session
     */
    public function setCourseId($course_id)
    {
        $this->course_id = $course_id;

        return $this;
    }

    /**
     * Get the value of course_id.
     *
     * @return integer
     */
    public function getCourseId()
    {
        return $this->course_id;
    }

    /**
     * Add Multiplechoice entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Multiplechoice $multiplechoice
     * @return \CoreBundle\Entity\Session
     */
    public function addMultiplechoice(Multiplechoice $multiplechoice)
    {
        $this->multiplechoices[] = $multiplechoice;

        return $this;
    }

    /**
     * Remove Multiplechoice entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Multiplechoice $multiplechoice
     * @return \CoreBundle\Entity\Session
     */
    public function removeMultiplechoice(Multiplechoice $multiplechoice)
    {
        $this->multiplechoices->removeElement($multiplechoice);

        return $this;
    }

    /**
     * Get Multiplechoice entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMultiplechoices()
    {
        return $this->multiplechoices;
    }

    /**
     * Add Shortanswer entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Shortanswer $shortanswer
     * @return \CoreBundle\Entity\Session
     */
    public function addShortanswer(Shortanswer $shortanswer)
    {
        $this->shortanswers[] = $shortanswer;

        return $this;
    }

    /**
     * Remove Shortanswer entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Shortanswer $shortanswer
     * @return \CoreBundle\Entity\Session
     */
    public function removeShortanswer(Shortanswer $shortanswer)
    {
        $this->shortanswers->removeElement($shortanswer);

        return $this;
    }

    /**
     * Get Shortanswer entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getShortanswers()
    {
        return $this->shortanswers;
    }

    /**
     * Add Trueorfalse entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Trueorfalse $trueorfalse
     * @return \CoreBundle\Entity\Session
     */
    public function addTrueorfalse(Trueorfalse $trueorfalse)
    {
        $this->trueorfalses[] = $trueorfalse;

        return $this;
    }

    /**
     * Remove Trueorfalse entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Trueorfalse $trueorfalse
     * @return \CoreBundle\Entity\Session
     */
    public function removeTrueorfalse(Trueorfalse $trueorfalse)
    {
        $this->trueorfalses->removeElement($trueorfalse);

        return $this;
    }

    /**
     * Get Trueorfalse entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrueorfalses()
    {
        return $this->trueorfalses;
    }

    /**
     * Set Course entity (many to one).
     *
     * @param \CoreBundle\Entity\Course $course
     * @return \CoreBundle\Entity\Session
     */
    public function setCourse(Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get Course entity (many to one).
     *
     * @return \CoreBundle\Entity\Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    public function __sleep()
    {
        return array('id', 'title', 'detail', 'createdat', 'finishedat', 'order', 'course_id');
    }
}