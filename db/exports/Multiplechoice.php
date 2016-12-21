<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Multiplechoice
 *
 * @ORM\Entity()
 * @ORM\Table(name="multiplechoice", indexes={@ORM\Index(name="fk_multiplechoice_session1_idx", columns={"session_id"}), @ORM\Index(name="fk_multiplechoice_course1_idx", columns={"course_id"})})
 */
class Multiplechoice
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
     * @ORM\Column(type="string", length=500)
     */
    protected $correctoption;

    /**
     * @ORM\Column(type="string", length=500)
     */
    protected $option1;

    /**
     * @ORM\Column(type="string", length=500)
     */
    protected $option2;

    /**
     * @ORM\Column(type="string", length=500)
     */
    protected $option3;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    protected $option4;

    /**
     * @ORM\Column(type="boolean", nullable=true)
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
     * @ORM\OneToMany(targetEntity="ResultMultiplechoice", mappedBy="multiplechoice")
     * @ORM\JoinColumn(name="id", referencedColumnName="multiplechoice_id", nullable=false)
     */
    protected $resultMultiplechoices;

    /**
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="multiplechoices")
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id", nullable=false)
     */
    protected $session;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="multiplechoices")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id", nullable=false)
     */
    protected $course;

    public function __construct()
    {
        $this->resultMultiplechoices = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Multiplechoice
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
     * @return \CoreBundle\Entity\Multiplechoice
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
     * @return \CoreBundle\Entity\Multiplechoice
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
     * @return \CoreBundle\Entity\Multiplechoice
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
     * @return \CoreBundle\Entity\Multiplechoice
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
     * @param string $correctoption
     * @return \CoreBundle\Entity\Multiplechoice
     */
    public function setCorrectoption($correctoption)
    {
        $this->correctoption = $correctoption;

        return $this;
    }

    /**
     * Get the value of correctoption.
     *
     * @return string
     */
    public function getCorrectoption()
    {
        return $this->correctoption;
    }

    /**
     * Set the value of option1.
     *
     * @param string $option1
     * @return \CoreBundle\Entity\Multiplechoice
     */
    public function setOption1($option1)
    {
        $this->option1 = $option1;

        return $this;
    }

    /**
     * Get the value of option1.
     *
     * @return string
     */
    public function getOption1()
    {
        return $this->option1;
    }

    /**
     * Set the value of option2.
     *
     * @param string $option2
     * @return \CoreBundle\Entity\Multiplechoice
     */
    public function setOption2($option2)
    {
        $this->option2 = $option2;

        return $this;
    }

    /**
     * Get the value of option2.
     *
     * @return string
     */
    public function getOption2()
    {
        return $this->option2;
    }

    /**
     * Set the value of option3.
     *
     * @param string $option3
     * @return \CoreBundle\Entity\Multiplechoice
     */
    public function setOption3($option3)
    {
        $this->option3 = $option3;

        return $this;
    }

    /**
     * Get the value of option3.
     *
     * @return string
     */
    public function getOption3()
    {
        return $this->option3;
    }

    /**
     * Set the value of option4.
     *
     * @param string $option4
     * @return \CoreBundle\Entity\Multiplechoice
     */
    public function setOption4($option4)
    {
        $this->option4 = $option4;

        return $this;
    }

    /**
     * Get the value of option4.
     *
     * @return string
     */
    public function getOption4()
    {
        return $this->option4;
    }

    /**
     * Set the value of active.
     *
     * @param boolean $active
     * @return \CoreBundle\Entity\Multiplechoice
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
     * @return \CoreBundle\Entity\Multiplechoice
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
     * @return \CoreBundle\Entity\Multiplechoice
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
     * Add ResultMultiplechoice entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\ResultMultiplechoice $resultMultiplechoice
     * @return \CoreBundle\Entity\Multiplechoice
     */
    public function addResultMultiplechoice(ResultMultiplechoice $resultMultiplechoice)
    {
        $this->resultMultiplechoices[] = $resultMultiplechoice;

        return $this;
    }

    /**
     * Remove ResultMultiplechoice entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\ResultMultiplechoice $resultMultiplechoice
     * @return \CoreBundle\Entity\Multiplechoice
     */
    public function removeResultMultiplechoice(ResultMultiplechoice $resultMultiplechoice)
    {
        $this->resultMultiplechoices->removeElement($resultMultiplechoice);

        return $this;
    }

    /**
     * Get ResultMultiplechoice entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResultMultiplechoices()
    {
        return $this->resultMultiplechoices;
    }

    /**
     * Set Session entity (many to one).
     *
     * @param \CoreBundle\Entity\Session $session
     * @return \CoreBundle\Entity\Multiplechoice
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
     * @return \CoreBundle\Entity\Multiplechoice
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
        return array('id', 'title', 'detail', 'createdat', 'lastchanges', 'correctoption', 'option1', 'option2', 'option3', 'option4', 'active', 'session_id', 'course_id');
    }
}