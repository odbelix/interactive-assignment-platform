<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\ResultShortanswer
 *
 * @ORM\Entity()
 * @ORM\Table(name="result_shortanswer", indexes={@ORM\Index(name="fk_result_session1_idx", columns={"session_id"}), @ORM\Index(name="fk_result_course1_idx", columns={"course_id"}), @ORM\Index(name="fk_result_shortanswer1_idx", columns={"shortanswer_id"})})
 */
class ResultShortanswer
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
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    protected $answer;

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
    protected $shortanswer_id;

    /**
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="resultShortanswers")
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id", nullable=false)
     */
    protected $session;

    /**
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="resultShortanswers")
     * @ORM\JoinColumn(name="course_id", referencedColumnName="id", nullable=false)
     */
    protected $course;

    /**
     * @ORM\ManyToOne(targetEntity="Shortanswer", inversedBy="resultShortanswers")
     * @ORM\JoinColumn(name="shortanswer_id", referencedColumnName="id", nullable=false)
     */
    protected $shortanswer;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\ResultShortanswer
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
     * @return \CoreBundle\Entity\ResultShortanswer
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
     * @return \CoreBundle\Entity\ResultShortanswer
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
     * Set the value of answer.
     *
     * @param string $answer
     * @return \CoreBundle\Entity\ResultShortanswer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get the value of answer.
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set the value of session_id.
     *
     * @param integer $session_id
     * @return \CoreBundle\Entity\ResultShortanswer
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
     * @return \CoreBundle\Entity\ResultShortanswer
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
     * Set the value of shortanswer_id.
     *
     * @param integer $shortanswer_id
     * @return \CoreBundle\Entity\ResultShortanswer
     */
    public function setShortanswerId($shortanswer_id)
    {
        $this->shortanswer_id = $shortanswer_id;

        return $this;
    }

    /**
     * Get the value of shortanswer_id.
     *
     * @return integer
     */
    public function getShortanswerId()
    {
        return $this->shortanswer_id;
    }

    /**
     * Set Session entity (many to one).
     *
     * @param \CoreBundle\Entity\Session $session
     * @return \CoreBundle\Entity\ResultShortanswer
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
     * @return \CoreBundle\Entity\ResultShortanswer
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
     * Set Shortanswer entity (many to one).
     *
     * @param \CoreBundle\Entity\Shortanswer $shortanswer
     * @return \CoreBundle\Entity\ResultShortanswer
     */
    public function setShortanswer(Shortanswer $shortanswer = null)
    {
        $this->shortanswer = $shortanswer;

        return $this;
    }

    /**
     * Get Shortanswer entity (many to one).
     *
     * @return \CoreBundle\Entity\Shortanswer
     */
    public function getShortanswer()
    {
        return $this->shortanswer;
    }

    public function __sleep()
    {
        return array('id', 'createdat', 'rut', 'answer', 'session_id', 'course_id', 'shortanswer_id');
    }
}