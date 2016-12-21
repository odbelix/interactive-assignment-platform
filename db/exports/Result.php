<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreBundle\Entity\Result
 *
 * @ORM\Entity()
 * @ORM\Table(name="`result`")
 */
class Result
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
    protected $rut;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $iscorrect;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    protected $shortanswer;

    /**
     * @ORM\Column(type="integer")
     */
    protected $question;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \CoreBundle\Entity\Result
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
     * Set the value of rut.
     *
     * @param string $rut
     * @return \CoreBundle\Entity\Result
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
     * @return \CoreBundle\Entity\Result
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
     * Set the value of shortanswer.
     *
     * @param string $shortanswer
     * @return \CoreBundle\Entity\Result
     */
    public function setShortanswer($shortanswer)
    {
        $this->shortanswer = $shortanswer;

        return $this;
    }

    /**
     * Get the value of shortanswer.
     *
     * @return string
     */
    public function getShortanswer()
    {
        return $this->shortanswer;
    }

    /**
     * Set the value of question.
     *
     * @param integer $question
     * @return \CoreBundle\Entity\Result
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get the value of question.
     *
     * @return integer
     */
    public function getQuestion()
    {
        return $this->question;
    }

    public function __sleep()
    {
        return array('id', 'rut', 'iscorrect', 'shortanswer', 'question');
    }
}