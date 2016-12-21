<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Trueorfalse
 *
 * @ORM\Entity()
 * @ORM\Table(name="trueorfalse", indexes={@ORM\Index(name="fk_trueorfalse_session1_idx", columns={"session_id"}), @ORM\Index(name="fk_trueorfalse_course1_idx", columns={"course_id"})})
 */
class Trueorfalse
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
     * @ORM\Column(type="text")
     */
    protected $detail;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdat;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $lastchanges;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $correctoption;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * @ORM\Column(type="integer")
     */
    protected $session_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $course_id;

    /**
     * @ORM\OneToMany(targetEntity="ResultTrueorfalse", mappedBy="trueorfalse")
     * @ORM\JoinColumn(name="id", referencedColumnName="trueorfalse_id", nullable=false)
     */
    protected $resultTrueorfalses;

    /**
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="trueorfalses")
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id", nullable=false)
     */
    protected $session;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="trueorfalses")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id", nullable=false)
     */
    protected $course;

    public function __construct()
    {
        $this->resultTrueorfalses = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Trueorfalse
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
     * @return \CoreBundle\Entity\Trueorfalse
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
     * @return \CoreBundle\Entity\Trueorfalse
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
     * @return \CoreBundle\Entity\Trueorfalse
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
     * Set the value of lastchanges.
     *
     * @param \DateTime $lastchanges
     * @return \CoreBundle\Entity\Trueorfalse
     */
    public function setLastchanges($lastchanges)
    {
        $this->lastchanges = $lastchanges;

        return $this;
    }

    /**
     * Get the value of lastchanges.
     *
     * @return \DateTime
     */
    public function getLastchanges()
    {
        return $this->lastchanges;
    }

    /**
     * Set the value of correctoption.
     *
     * @param boolean $correctoption
     * @return \CoreBundle\Entity\Trueorfalse
     */
    public function setCorrectoption($correctoption)
    {
        $this->correctoption = $correctoption;

        return $this;
    }

    /**
     * Get the value of correctoption.
     *
     * @return boolean
     */
    public function getCorrectoption()
    {
        return $this->correctoption;
    }

    /**
     * Set the value of active.
     *
     * @param boolean $active
     * @return \CoreBundle\Entity\Trueorfalse
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the value of active.
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of session_id.
     *
     * @param integer $session_id
     * @return \CoreBundle\Entity\Trueorfalse
     */
    public function setSessionId($session_id)
    {
        $this->session_id = $session_id;

        return $this;
    }

    /**
     * Get the value of session_id.
     *
     * @return integer
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    /**
     * Set the value of course_id.
     *
     * @param integer $course_id
     * @return \CoreBundle\Entity\Trueorfalse
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
     * Add ResultTrueorfalse entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\ResultTrueorfalse $resultTrueorfalse
     * @return \CoreBundle\Entity\Trueorfalse
     */
    public function addResultTrueorfalse(ResultTrueorfalse $resultTrueorfalse)
    {
        $this->resultTrueorfalses[] = $resultTrueorfalse;

        return $this;
    }

    /**
     * Remove ResultTrueorfalse entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\ResultTrueorfalse $resultTrueorfalse
     * @return \CoreBundle\Entity\Trueorfalse
     */
    public function removeResultTrueorfalse(ResultTrueorfalse $resultTrueorfalse)
    {
        $this->resultTrueorfalses->removeElement($resultTrueorfalse);

        return $this;
    }

    /**
     * Get ResultTrueorfalse entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResultTrueorfalses()
    {
        return $this->resultTrueorfalses;
    }

    /**
     * Set Session entity (many to one).
     *
     * @param \CoreBundle\Entity\Session $session
     * @return \CoreBundle\Entity\Trueorfalse
     */
    public function setSession(Session $session = null)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get Session entity (many to one).
     *
     * @return \CoreBundle\Entity\Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set Course entity (many to one).
     *
     * @param \CoreBundle\Entity\Course $course
     * @return \CoreBundle\Entity\Trueorfalse
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
        return array('id', 'title', 'detail', 'createdat', 'lastchanges', 'correctoption', 'active', 'session_id', 'course_id');
    }
}