<?php

namespace ApiBundle\Controller;

use CoreBundle\Entity\Course;
use CoreBundle\Entity\Session;
use CoreBundle\Entity\Trueorfalse;


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


class TrueorfalseController extends Controller
{


  /**
  * Get True or False question
  * @Get("/course/session/trueorfalse/get/{id}/{courseid}/{sessionid}")
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
  public function getTrueorfalseAction($id,$courseid,$sessionid)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();

    $parameters = array('id' => $id,'course' => $courseid, 'session' => $sessionid);

    $query  = $em->createQuery("
    SELECT q.id,q.title,q.detail,q.correctoption,q.createdat,q.session_id,q.course_id
    FROM CoreBundle\Entity\Trueorfalse q
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
  * Create True of False
  * @POST("/course/session/trueorfalse/add")
  * @ApiDoc(
  *  resource=true,
  *  description="Add True or false question",
  *  requirements={
  *      {"name"="title", "dataType"="string", "requirement"="true", "description"="question's title"},
  *      {"name"="detail", "dataType"="string", "requirement"="true", "description"="question's detail"},
  *      {"name"="correctoption", "dataType"="int", "requirement"="true", "description"="Correct option"},
  *      {"name"="active", "dataType"="int", "requirement"="true", "description"="question's state"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function addTrueorfalseAction(Request $request)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();

    if ($request->getMethod() == 'POST') {
      $title = $request->request->get('title');
      $detail = $request->request->get('detail');
      $correctoption = $request->request->get('correctoption');
      $active = $request->request->get('active');
      $courseid = $request->request->get('courseid');
      $sessionid = $request->request->get('sessionid');
      $course = $em->getRepository('CoreBundle:Course')->findOneById($courseid);
      $session = $em->getRepository('CoreBundle:Session')->findOneById($sessionid);
    }

    try {
      $trueorfalse = new Trueorfalse();
      $trueorfalse->setTitle($title);
      $trueorfalse->setDetail($detail);
      $trueorfalse->setCorrectoption($correctoption);
      $trueorfalse->setActive($active);
      $trueorfalse->setCourse($course);
      $trueorfalse->setSession($session);
      $trueorfalse->setCreatedAt(new \DateTime("now"));
      $em->persist($trueorfalse);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"ok",
        "questionid" => $trueorfalse->getId()
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
  * Update True of False
  * @PUT("/course/session/trueorfalse/update/{id}")
  * @ApiDoc(
  *  resource=true,
  *  description="Update True or false question",
  *  requirements={
  *      {"name"="id", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="title", "dataType"="string", "requirement"="true", "description"="question's title"},
  *      {"name"="detail", "dataType"="string", "requirement"="true", "description"="question's detail"},
  *      {"name"="correctoption", "dataType"="int", "requirement"="true", "description"="Correct option"},
  *      {"name"="active", "dataType"="int", "requirement"="true", "description"="question's state"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function updateTrueorfalseActionAction(Request $request,$id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $trueorfalse = $em->getRepository('CoreBundle:Trueorfalse')->findOneById($id);
    if ( !$trueorfalse ) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: No existe una pregunta con el id"
      ));
      return $jsonResponse;
    }

    $title = $request->request->get('title');
    $detail = $request->request->get('detail');
    $correctoption = $request->request->get('correctoption');
    $active = $request->request->get('active');
    $courseid = $request->request->get('courseid');
    $sessionid = $request->request->get('sessionid');
    $course = $em->getRepository('CoreBundle:Course')->findOneById($courseid);
    $session = $em->getRepository('CoreBundle:Session')->findOneById($sessionid);


    try {
      //$trueorfalse = new Trueorfalse();
      $trueorfalse->setTitle($title);
      $trueorfalse->setDetail($detail);
      $trueorfalse->setCorrectoption($correctoption);
      $trueorfalse->setActive($active);
      $trueorfalse->setCourse($course);
      $trueorfalse->setSession($session);
      $trueorfalse->setLastchanges(new \DateTime("now"));
      $em->persist($trueorfalse);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"update",
        "questionid" => $trueorfalse->getId()
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
  * Update True or false state
  * @PUT("/course/session/trueorfalse/update/state/{id}")
  * @ApiDoc(
  *  resource=true,
  *  description="Update True or false question",
  *  requirements={
  *      {"name"="id", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="active", "dataType"="int", "requirement"="true", "description"="question's state"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function updateStateTrueorfalseActionAction(Request $request,$id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $trueorfalse = $em->getRepository('CoreBundle:Trueorfalse')->findOneById($id);
    if ( !$trueorfalse ) {
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
      //$trueorfalse = new Trueorfalse();
      $trueorfalse->setActive($active);
      $trueorfalse->setCourse($course);
      $trueorfalse->setSession($session);
      $trueorfalse->setLastchanges(new \DateTime("now"));
      $em->persist($trueorfalse);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"update",
        "active" => $active,
        "questionid" => $trueorfalse->getId()
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
  * Delete True of False
  * @DELETE("/course/session/trueorfalse/delete/{id}")
  * @ApiDoc(
  *  resource=true,
  *  description="Update True or false question",
  *  requirements={
  *      {"name"="id", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function deleteTrueorfalseActionAction(Request $request,$id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $trueorfalse = $em->getRepository('CoreBundle:Trueorfalse')->findOneById($id);
    if ( !$trueorfalse ) {
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
      $em->remove($trueorfalse);
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
