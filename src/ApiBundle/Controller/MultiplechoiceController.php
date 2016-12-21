<?php

namespace ApiBundle\Controller;

use CoreBundle\Entity\Course;
use CoreBundle\Entity\Session;
use CoreBundle\Entity\Multiplechoice;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
//REST
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Delete;


//For documentation path
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use UbiAppStatsBundle\Entity\ServiceStat;


class MultiplechoiceController extends Controller
{


  /**
  * Get Multiple choice question
  * @Get("/course/session/multiplechoice/get/{id}/{courseid}/{sessionid}")
  * @ApiDoc(
  *  resource=true,
  *  description="Get question information",
  *  requirements={
  *      {"name"="id", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function getMultiplechoiceAction($id,$courseid,$sessionid)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();

    $parameters = array('id' => $id,'course' => $courseid, 'session' => $sessionid);

    $query  = $em->createQuery("
    SELECT q.id,q.title,q.detail,q.correctoption,q.option1,q.option2,q.option3,q.option4,q.createdat,q.session_id,q.course_id
    FROM CoreBundle\Entity\Multiplechoice q
    WHERE  q.id = :id
    AND q.session_id = :session
    AND q.course_id = :course")
    ->setParameters($parameters);

    try {
      $question = $query->getSingleResult();
      return $question;
    } catch (\Doctrine\ORM\NoResultException $e) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"No existen la pregunta para el identificador solicitado"
      ));
    }
    return $jsonResponse;
  }




  /**
  * Create Multiple choice
  * @POST("/course/session/multiplechoice/add")
  * @ApiDoc(
  *  resource=true,
  *  description="Add Multiple choise question",
  *  requirements={
  *      {"name"="title", "dataType"="string", "requirement"="true", "description"="question's title"},
  *      {"name"="detail", "dataType"="string", "requirement"="true", "description"="question's detail"},
  *      {"name"="correctoption", "dataType"="string", "requirement"="true", "description"="Correct option"},
  *      {"name"="option1", "dataType"="string", "requirement"="true", "description"="option 1"},
  *      {"name"="option2", "dataType"="string", "requirement"="true", "description"="option 2"},
  *      {"name"="option3", "dataType"="string", "requirement"="true", "description"="option 3"},
  *      {"name"="option4", "dataType"="string", "requirement"="false", "description"="option 4"},
  *      {"name"="active", "dataType"="int", "requirement"="true", "description"="question's state"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function addMultiplechoiceActionAction(Request $request)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();

    if ($request->getMethod() == 'POST') {
      $title = $request->request->get('title');
      $detail = $request->request->get('detail');
      $correctoption = $request->request->get('correctoption');
      $option1 = $request->request->get('option1');
      $option2 = $request->request->get('option2');
      $option3 = $request->request->get('option3');
      $option4 = $request->request->get('option4');
      $active = $request->request->get('active');
      $courseid = $request->request->get('courseid');
      $sessionid = $request->request->get('sessionid');
      $course = $em->getRepository('CoreBundle:Course')->findOneById($courseid);
      $session = $em->getRepository('CoreBundle:Session')->findOneById($sessionid);
    }

    try {
      $multiplechoice = new Multiplechoice();
      $multiplechoice->setTitle($title);
      $multiplechoice->setDetail($detail);
      $multiplechoice->setCorrectoption($correctoption);
      $multiplechoice->setOption1($option1);
      $multiplechoice->setOption2($option2);
      $multiplechoice->setOption3($option3);
      $multiplechoice->setOption4($option4);
      $multiplechoice->setActive($active);
      $multiplechoice->setCourse($course);
      $multiplechoice->setSession($session);
      $multiplechoice->setCreatedAt(new \DateTime("now"));
      $em->persist($multiplechoice);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"ok",
        "questionid" => $multiplechoice->getId()
      ));
    } catch (\Doctrine\ORM\ORMException $e) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: Problem with questionid"
      ));
    }
    return $jsonResponse;
  }


  /**
  * Update Multiple choice
  * @PUT("/course/session/multiplechoice/update/{id}")
  * @ApiDoc(
  *  resource=true,
  *  description="Update Multiple choise question",
  *  requirements={
  *      {"name"="id", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="title", "dataType"="string", "requirement"="true", "description"="question's title"},
  *      {"name"="detail", "dataType"="string", "requirement"="true", "description"="question's detail"},
  *      {"name"="correctoption", "dataType"="string", "requirement"="true", "description"="Correct option"},
  *      {"name"="option1", "dataType"="string", "requirement"="true", "description"="option 1"},
  *      {"name"="option2", "dataType"="string", "requirement"="true", "description"="option 2"},
  *      {"name"="option3", "dataType"="string", "requirement"="true", "description"="option 3"},
  *      {"name"="option4", "dataType"="string", "requirement"="false", "description"="option 4"},
  *      {"name"="active", "dataType"="int", "requirement"="true", "description"="question's state"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function updateMultiplechoiceActionAction(Request $request,$id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $multiplechoice = $em->getRepository('CoreBundle:Multiplechoice')->findOneById($id);
    if ( !$multiplechoice ) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: No existe una pregunta con el id"
      ));
      return $jsonResponse;
    }

    $title = $request->request->get('title');
    $detail = $request->request->get('detail');
    $correctoption = $request->request->get('correctoption');
    $option1 = $request->request->get('option1');
    $option2 = $request->request->get('option2');
    $option3 = $request->request->get('option3');
    $option4 = $request->request->get('option4');
    $active = $request->request->get('active');
    $courseid = $request->request->get('courseid');
    $sessionid = $request->request->get('sessionid');
    $course = $em->getRepository('CoreBundle:Course')->findOneById($courseid);
    $session = $em->getRepository('CoreBundle:Session')->findOneById($sessionid);


    try {
      //$multiplechoice = new Multiplechoice();
      $multiplechoice->setTitle($title);
      $multiplechoice->setDetail($detail);
      $multiplechoice->setCorrectoption($correctoption);
      $multiplechoice->setOption1($option1);
      $multiplechoice->setOption2($option2);
      $multiplechoice->setOption3($option3);
      $multiplechoice->setOption4($option4);
      $multiplechoice->setActive($active);
      $multiplechoice->setCourse($course);
      $multiplechoice->setSession($session);
      $multiplechoice->setLastchanges(new \DateTime("now"));
      $em->persist($multiplechoice);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"update",
        "questionid" => $multiplechoice->getId()
      ));
    } catch (\Doctrine\ORM\ORMException $e) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: Problem with question"
      ));
    }
    return $jsonResponse;
  }

  /**
  * Update Multiple choise state
  * @PUT("/course/session/multiplechoice/update/state/{id}")
  * @ApiDoc(
  *  resource=true,
  *  description="Update Multiple choise question",
  *  requirements={
  *      {"name"="id", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="active", "dataType"="int", "requirement"="true", "description"="question's state"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function updateStateMultiplechoiceActionAction(Request $request,$id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $multiplechoice = $em->getRepository('CoreBundle:Multiplechoice')->findOneById($id);
    if ( !$multiplechoice ) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: No existe una pregunta con el id"
      ));
      return $jsonResponse;
    }

    $active = $request->request->get('active');
    $courseid = $request->request->get('courseid');
    $sessionid = $request->request->get('sessionid');
    $course = $em->getRepository('CoreBundle:Course')->findOneById($courseid);
    $session = $em->getRepository('CoreBundle:Session')->findOneById($sessionid);


    try {
      //$multiplechoice = new Multiplechoice();
      $multiplechoice->setActive($active);
      $multiplechoice->setCourse($course);
      $multiplechoice->setSession($session);
      $multiplechoice->setLastchanges(new \DateTime("now"));
      $em->persist($multiplechoice);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"update",
        "active" => $active,
        "questionid" => $multiplechoice->getId()
      ));
    } catch (\Doctrine\ORM\ORMException $e) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: Problem with question"
      ));
    }
    return $jsonResponse;
  }


  /**
  * Delete Multiple choice
  * @DELETE("/course/session/multiplechoice/delete/{id}")
  * @ApiDoc(
  *  resource=true,
  *  description="Update Multiple choise question",
  *  requirements={
  *      {"name"="id", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function deleteMultiplechoiceActionAction(Request $request,$id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $multiplechoice = $em->getRepository('CoreBundle:Multiplechoice')->findOneById($id);
    if ( !$multiplechoice ) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: No existe una pregunta con el id"
      ));
      return $jsonResponse;
    }

    $courseid = $request->request->get('courseid');
    $sessionid = $request->request->get('sessionid');
    $course = $em->getRepository('CoreBundle:Course')->findOneById($courseid);
    $session = $em->getRepository('CoreBundle:Session')->findOneById($sessionid);

    try {
      $em->remove($multiplechoice);
      $em->flush();
      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"delete",
        "questionid" => $id
      ));


    } catch (\Doctrine\ORM\ORMException $e) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: Problem with question"
      ));
    }
    return $jsonResponse;
  }

}
