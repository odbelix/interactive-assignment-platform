<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\ResultTrueorfalse
 *
 * @ORM\Entity()
 * @ORM\Table(name="result_trueorfalse", indexes={@ORM\Index(name="fk_result_session1_idx", columns={"session_id"}), @ORM\Index(name="fk_result_course1_idx", columns={"course_id"}), @ORM\Index(name="fk_result_trueorfalse_trueorfalse1_idx", columns={"trueorfalse_id"})})
 */
class ResultTrueorfalse
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdat;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $rut;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $iscorrect;

    /**
     * @ORM\Column(type="integer")
     */
    protected $session_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $course_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $trueorfalse_id;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $answer;

    /**
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="resultTrueorfalses")
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id", nullable=false)
     */
    protected $session;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="resultTrueorfalses")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id", nullable=false)
     */
    protected $course;

    /**
     * @ORM\ManyToOne(targetEntity="Trueorfalse", inversedBy="resultTrueorfalses")
     * @ORM\JoinColumn(name="trueorfalse_id", referencedColumnName="id", nullable=false)
     */
    protected $trueorfalse;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\ResultTrueorfalse
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
     * Set the value of createdat.
     *
     * @param \DateTime $createdat
     * @return \CoreBundle\Entity\ResultTrueorfalse
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
     * Set the value of rut.
     *
     * @param string $rut
     * @return \CoreBundle\Entity\ResultTrueorfalse
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get the value of rut.
     *
     * @return string
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set the value of iscorrect.
     *
     * @param boolean $iscorrect
     * @return \CoreBundle\Entity\ResultTrueorfalse
     */
    public function setIscorrect($iscorrect)
    {
        $this->iscorrect = $iscorrect;

        return $this;
    }

    /**
     * Get the value of iscorrect.
     *
     * @return boolean
     */
    public function getIscorrect()
    {
        return $this->iscorrect;
    }

    /**
     * Set the value of session_id.
     *
     * @param integer $session_id
     * @return \CoreBundle\Entity\ResultTrueorfalse
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
     * @return \CoreBundle\Entity\ResultTrueorfalse
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
     * Set the value of trueorfalse_id.
     *
     * @param integer $trueorfalse_id
     * @return \CoreBundle\Entity\ResultTrueorfalse
     */
    public function setTrueorfalseId($trueorfalse_id)
    {
        $this->trueorfalse_id = $trueorfalse_id;

        return $this;
    }

    /**
     * Get the value of trueorfalse_id.
     *
     * @return integer
     */
    public function getTrueorfalseId()
    {
        return $this->trueorfalse_id;
    }

    /**
     * Set the value of answer.
     *
     * @param boolean $answer
     * @return \CoreBundle\Entity\ResultTrueorfalse
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get the value of answer.
     *
     * @return boolean
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set Session entity (many to one).
     *
     * @param \CoreBundle\Entity\Session $session
     * @return \CoreBundle\Entity\ResultTrueorfalse
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
     * @return \CoreBundle\Entity\ResultTrueorfalse
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

    /**
     * Set Trueorfalse entity (many to one).
     *
     * @param \CoreBundle\Entity\Trueorfalse $trueorfalse
     * @return \CoreBundle\Entity\ResultTrueorfalse
     */
    public function setTrueorfalse(Trueorfalse $trueorfalse = null)
    {
        $this->trueorfalse = $trueorfalse;

        return $this;
    }

    /**
     * Get Trueorfalse entity (many to one).
     *
     * @return \CoreBundle\Entity\Trueorfalse
     */
    public function getTrueorfalse()
    {
        return $this->trueorfalse;
    }

    public function __sleep()
    {
        return array('id', 'createdat', 'rut', 'iscorrect', 'session_id', 'course_id', 'trueorfalse_id', 'answer');
    }
}