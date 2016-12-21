<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CoreBundle\Entity\Course
 *
 * @ORM\Entity()
 * @ORM\Table(name="course")
 */
class Course
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $code;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdat;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $teacher;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $email;

    /**
     * @ORM\Column(name="`year`", type="string", length=45)
     */
    protected $year;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $period;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $accesscode;

    /**
     * @ORM\Column(name="`language`", type="string", length=2, nullable=true)
     */
    protected $language;

    /**
     * @ORM\OneToMany(targetEntity="Enrollment", mappedBy="course")
     * @ORM\JoinColumn(name="id", referencedColumnName="course_id", nullable=false)
     */
    protected $enrollments;

    /**
     * @ORM\OneToMany(targetEntity="Multiplechoice", mappedBy="course")
     * @ORM\JoinColumn(name="id", referencedColumnName="course_id", nullable=false)
     */
    protected $multiplechoices;

    /**
     * @ORM\OneToMany(targetEntity="Session", mappedBy="course")
     * @ORM\JoinColumn(name="id", referencedColumnName="course_id", nullable=false)
     */
    protected $sessions;

    /**
     * @ORM\OneToMany(targetEntity="Shortanswer", mappedBy="course")
     * @ORM\JoinColumn(name="id", referencedColumnName="course_id", nullable=false)
     */
    protected $shortanswers;

    /**
     * @ORM\OneToMany(targetEntity="Trueorfalse", mappedBy="course")
     * @ORM\JoinColumn(name="id", referencedColumnName="course_id", nullable=false)
     */
    protected $trueorfalses;

    public function __construct()
    {
        $this->enrollments = new ArrayCollection();
        $this->multiplechoices = new ArrayCollection();
        $this->sessions = new ArrayCollection();
        $this->shortanswers = new ArrayCollection();
        $this->trueorfalses = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Course
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
     * Set the value of code.
     *
     * @param string $code
     * @return \CoreBundle\Entity\Course
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of createdat.
     *
     * @param \DateTime $createdat
     * @return \CoreBundle\Entity\Course
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
     * Set the value of teacher.
     *
     * @param string $teacher
     * @return \CoreBundle\Entity\Course
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get the value of teacher.
     *
     * @return string
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set the value of email.
     *
     * @param string $email
     * @return \CoreBundle\Entity\Course
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of year.
     *
     * @param string $year
     * @return \CoreBundle\Entity\Course
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get the value of year.
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set the value of period.
     *
     * @param string $period
     * @return \CoreBundle\Entity\Course
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get the value of period.
     *
     * @return string
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set the value of accesscode.
     *
     * @param string $accesscode
     * @return \CoreBundle\Entity\Course
     */
    public function setAccesscode($accesscode)
    {
        $this->accesscode = $accesscode;

        return $this;
    }

    /**
     * Get the value of accesscode.
     *
     * @return string
     */
    public function getAccesscode()
    {
        return $this->accesscode;
    }

    /**
     * Set the value of language.
     *
     * @param string $language
     * @return \CoreBundle\Entity\Course
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get the value of language.
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Add Enrollment entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Enrollment $enrollment
     * @return \CoreBundle\Entity\Course
     */
    public function addEnrollment(Enrollment $enrollment)
    {
        $this->enrollments[] = $enrollment;

        return $this;
    }

    /**
     * Remove Enrollment entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Enrollment $enrollment
     * @return \CoreBundle\Entity\Course
     */
    public function removeEnrollment(Enrollment $enrollment)
    {
        $this->enrollments->removeElement($enrollment);

        return $this;
    }

    /**
     * Get Enrollment entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnrollments()
    {
        return $this->enrollments;
    }

    /**
     * Add Multiplechoice entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Multiplechoice $multiplechoice
     * @return \CoreBundle\Entity\Course
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
     * @return \CoreBundle\Entity\Course
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
     * Add Session entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Session $session
     * @return \CoreBundle\Entity\Course
     */
    public function addSession(Session $session)
    {
        $this->sessions[] = $session;

        return $this;
    }

    /**
     * Remove Session entity from collection (one to many).
     *
     * @param \CoreBundle\Entity\Session $session
     * @return \CoreBundle\Entity\Course
     */
    public function removeSession(Session $session)
    {
        $this->sessions->removeElement($session);

        return $this;
    }

    /**
     * Get Session entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * Add Shortanswer entity to collection (one to many).
     *
     * @param \CoreBundle\Entity\Shortanswer $shortanswer
     * @return \CoreBundle\Entity\Course
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
     * @return \CoreBundle\Entity\Course
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
     * @return \CoreBundle\Entity\Course
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
     * @return \CoreBundle\Entity\Course
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

    public function __sleep()
    {
        return array('id', 'code', 'createdat', 'teacher', 'email', 'year', 'period', 'accesscode', 'language');
    }
}