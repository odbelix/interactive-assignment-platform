<?php

namespace ApiBundle\Controller;

use CoreBundle\Entity\Course;
use CoreBundle\Entity\Session;
use CoreBundle\Entity\Trueorfalse;
use CoreBundle\Entity\Shortanswer;
use CoreBundle\Entity\Multiplechoice;
use CoreBundle\Entity\ResultShortanswer;
use CoreBundle\Entity\ResultMultiplechoice;
use CoreBundle\Entity\ResultTrueorfalse;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

//REST
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;

//For documentation path
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use UbiAppStatsBundle\Entity\ServiceStat;


class MobileController extends Controller
{

  /**
  * Add result for short answer question
  * @POST("/mobile/result/shortanswer/add")
  * @ApiDoc(
  *  resource=true,
  *  description="Add result for short answer question",
  *  requirements={
  *      {"name"="rut", "dataType"="string", "requirement"="true", "description"="student id"},
  *      {"name"="answer", "dataType"="string", "requirement"="false", "description"="short answer"},
  *      {"name"="questionid", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function addResultShortanswerAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $jsonResponse = new JsonResponse();

    if ($request->getMethod() == 'POST') {

      $rut = $request->request->get('rut');
      $answer = $request->request->get('answer');
      $courseid = $request->request->get('courseid');
      $sessionid = $request->request->get('sessionid');
      $questionid = $request->request->get('questionid');
      $course = $em->getRepository('CoreBundle:Course')->findOneById($courseid);
      $session = $em->getRepository('CoreBundle:Session')->findOneById($sessionid);
      $question = $em->getRepository('CoreBundle:Shortanswer')->findOneById($questionid);
    }
    else {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Invalid method"
      ));
      return $jsonResponse;
    }

    try {

      $result = new ResultShortanswer();
      $result->setRut($rut);
      $result->setAnswer($answer);
      $result->setShortanswer($question);
      $result->setCourse($course);
      $result->setSession($session);
      $result->setCreatedAt(new \DateTime("now"));

      $em->persist($result);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"ok",
        "resultid" => $result->getId()
      ));

    } catch(\Doctrine\ORM\ORMException $e){
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: Problem with Resultid"
      ));
    }
    return $jsonResponse;
  }

  /**
  * Add result for True of False question
  * @POST("/mobile/result/trueorfalse/add")
  * @ApiDoc(
  *  resource=true,
  *  description="Add result for true or false question1",
  *  requirements={
  *      {"name"="rut", "dataType"="string", "requirement"="true", "description"="student id"},
  *      {"name"="answer", "dataType"="int", "requirement"="false", "description"="answer"},
  *      {"name"="questionid", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function addResultTrueorfalseAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $jsonResponse = new JsonResponse();

    if ($request->getMethod() == 'POST') {

      $rut = $request->request->get('rut');
      $answer = $request->request->get('answer');
      $courseid = $request->request->get('courseid');
      $sessionid = $request->request->get('sessionid');
      $questionid = $request->request->get('questionid');
      $course = $em->getRepository('CoreBundle:Course')->findOneById($courseid);
      $session = $em->getRepository('CoreBundle:Session')->findOneById($sessionid);
      $question = $em->getRepository('CoreBundle:Trueorfalse')->findOneById($questionid);
    }
    else {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Invalid method"
      ));
      return $jsonResponse;
    }

    try {
      $result = new ResultTrueorfalse();
      $result->setRut($rut);
      $result->setAnswer($answer);
      if ( $answer ==  $question->getCorrectoption() ) {
        $result->setIscorrect(1);
      }
      else {
        $result->setIscorrect(0);
      }

      $result->setTrueorfalse($question);
      $result->setCourse($course);
      $result->setSession($session);
      $result->setCreatedAt(new \DateTime("now"));

      $em->persist($result);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"ok",
        "resultid" => $result->getId()
      ));

    } catch(\Doctrine\ORM\ORMException $e){
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: Problem with Resultid"
      ));
    }
    return $jsonResponse;
  }

  /**
  * Add result for Multiple choice question
  * @POST("/mobile/result/multiplechoice/add")
  * @ApiDoc(
  *  resource=true,
  *  description="Add result for multiplcechoice question",
  *  requirements={
  *      {"name"="rut", "dataType"="string", "requirement"="true", "description"="student id"},
  *      {"name"="answer", "dataType"="int", "requirement"="false", "description"="answer"},
  *      {"name"="questionid", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function addResultMultiplechoiceAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $jsonResponse = new JsonResponse();

    if ($request->getMethod() == 'POST') {

      $rut = $request->request->get('rut');
      $answer = $request->request->get('answer');
      $courseid = $request->request->get('courseid');
      $sessionid = $request->request->get('sessionid');
      $questionid = $request->request->get('questionid');
      $course = $em->getRepository('CoreBundle:Course')->findOneById($courseid);
      $session = $em->getRepository('CoreBundle:Session')->findOneById($sessionid);
      $question = $em->getRepository('CoreBundle:multiplechoice')->findOneById($questionid);
    }
    else {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Invalid method"
      ));
      return $jsonResponse;
    }

    try {
      $result = new ResultMultiplechoice();
      $result->setRut($rut);
      $result->setAnswer($answer);

      if ( strcmp($answer,$question->getCorrectoption())  == 0 ) {
        $result->setIscorrect(1);
      }
      else {
        $result->setIscorrect(0);
      }

      $result->setMultiplechoice($question);
      $result->setCourse($course);
      $result->setSession($session);
      $result->setCreatedAt(new \DateTime("now"));

      $em->persist($result);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"ok",
        "resultid" => $result->getId()
      ));

    } catch(\Doctrine\ORM\ORMException $e){
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: Problem with Resultid"
      ));
    }
    return $jsonResponse;
  }

}
