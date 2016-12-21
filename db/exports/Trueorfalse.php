<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\Trueorfalse
 *
 * @ORM\Entity()
 * @ORM\Table(name="trueorfalse", indexes={@ORM\Index(name="fk_trueorfalse_session1_idx", columns={"session_id"})})
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
    protected $option1;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $option2;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * @ORM\Column(type="integer")
     */
    protected $session_id;

    /**
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="trueorfalses")
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id", nullable=false)
     */
    protected $session;

    public function __construct()
    {
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
     * Set the value of option1.
     *
     * @param boolean $option1
     * @return \CoreBundle\Entity\Trueorfalse
     */
    public function setOption1($option1)
    {
        $this->option1 = $option1;

        return $this;
    }

    /**
     * Get the value of option1.
     *
     * @return boolean
     */
    public function getOption1()
    {
        return $this->option1;
    }

    /**
     * Set the value of option2.
     *
     * @param boolean $option2
     * @return \CoreBundle\Entity\Trueorfalse
     */
    public function setOption2($option2)
    {
        $this->option2 = $option2;

        return $this;
    }

    /**
     * Get the value of option2.
     *
     * @return boolean
     */
    public function getOption2()
    {
        return $this->option2;
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

    public function __sleep()
    {
        return array('id', 'title', 'detail', 'createdat', 'lastchanges', 'correctoption', 'option1', 'option2', 'active', 'session_id');
    }
}