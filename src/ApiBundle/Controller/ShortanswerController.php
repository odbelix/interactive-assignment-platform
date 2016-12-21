<?php

namespace ApiBundle\Controller;

use CoreBundle\Entity\Course;
use CoreBundle\Entity\Session;
use CoreBundle\Entity\Shortanswer;



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


class ShortanswerController extends Controller
{


  /**
  * Get Short answer question
  * @Get("/course/session/shortanswer/get/{id}/{courseid}/{sessionid}")
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
  public function getShortanswerAction($id,$courseid,$sessionid)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();

    $parameters = array('id' => $id,'course' => $courseid, 'session' => $sessionid);


    $query  = $em->createQuery("
    SELECT q.id,q.title,q.detail,q.suggestion,q.createdat,q.session_id,q.course_id
    FROM CoreBundle\Entity\Shortanswer q
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
  * Create Short answer
  * @POST("/course/session/shortanswer/add")
  * @ApiDoc(
  *  resource=true,
  *  description="Add Short answer question",
  *  requirements={
  *      {"name"="title", "dataType"="string", "requirement"="true", "description"="question's title"},
  *      {"name"="detail", "dataType"="string", "requirement"="true", "description"="question's detail"},
  *      {"name"="suggestion", "dataType"="int", "requirement"="true", "description"="Question's Suggestion"},
  *      {"name"="active", "dataType"="int", "requirement"="true", "description"="question's state"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function addShortanswerActionAction(Request $request)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();

    if ($request->getMethod() == 'POST') {
      $title = $request->request->get('title');
      $detail = $request->request->get('detail');
      $suggestion = $request->request->get('suggestion');
      $active = $request->request->get('active');
      $courseid = $request->request->get('courseid');
      $sessionid = $request->request->get('sessionid');
      $course = $em->getRepository('CoreBundle:Course')->findOneById($courseid);
      $session = $em->getRepository('CoreBundle:Session')->findOneById($sessionid);
    }

    try {
      $shortanswer = new Shortanswer();
      $shortanswer->setTitle($title);
      $shortanswer->setDetail($detail);
      $shortanswer->setSuggestion($suggestion);
      $shortanswer->setActive($active);
      $shortanswer->setCourse($course);
      $shortanswer->setSession($session);
      $shortanswer->setCreatedAt(new \DateTime("now"));
      $em->persist($shortanswer);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"ok",
        "questionid" => $shortanswer->getId()
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
  * Update Short answer
  * @PUT("/course/session/shortanswer/update/{id}")
  * @ApiDoc(
  *  resource=true,
  *  description="Update Short answer question",
  *  requirements={
  *      {"name"="id", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="title", "dataType"="string", "requirement"="true", "description"="question's title"},
  *      {"name"="detail", "dataType"="string", "requirement"="true", "description"="question's detail"},
  *      {"name"="suggestion", "dataType"="int", "requirement"="true", "description"="Question's Suggestion"},
  *      {"name"="active", "dataType"="int", "requirement"="true", "description"="question's state"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function updateShortanswerActionAction(Request $request,$id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $shortanswer = $em->getRepository('CoreBundle:Shortanswer')->findOneById($id);
    if ( !$shortanswer ) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: No existe una pregunta con el id"
      ));
      return $jsonResponse;
    }

    $title = $request->request->get('title');
    $detail = $request->request->get('detail');
    $suggestion = $request->request->get('suggestion');
    $active = $request->request->get('active');
    $courseid = $request->request->get('courseid');
    $sessionid = $request->request->get('sessionid');
    $course = $em->getRepository('CoreBundle:Course')->findOneById($courseid);
    $session = $em->getRepository('CoreBundle:Session')->findOneById($sessionid);


    try {
      //$shortanswer = new Shortanswer();
      $shortanswer->setTitle($title);
      $shortanswer->setDetail($detail);
      $shortanswer->setSuggestion($suggestion);
      $shortanswer->setActive($active);
      $shortanswer->setCourse($course);
      $shortanswer->setSession($session);
      $shortanswer->setLastchanges(new \DateTime("now"));
      $em->persist($shortanswer);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"update",
        "questionid" => $shortanswer->getId()
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
  * Update Short answer state
  * @PUT("/course/session/shortanswer/update/state/{id}")
  * @ApiDoc(
  *  resource=true,
  *  description="Update Short answer question",
  *  requirements={
  *      {"name"="id", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="active", "dataType"="int", "requirement"="true", "description"="question's state"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function updateStateShortanswerActionAction(Request $request,$id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $shortanswer = $em->getRepository('CoreBundle:Shortanswer')->findOneById($id);
    if ( !$shortanswer ) {
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
      //$shortanswer = new Shortanswer();
      $shortanswer->setActive($active);
      $shortanswer->setCourse($course);
      $shortanswer->setSession($session);
      $shortanswer->setLastchanges(new \DateTime("now"));
      $em->persist($shortanswer);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"update",
        "active" => $active,
        "questionid" => $shortanswer->getId()
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
  * Delete Short answer
  * @DELETE("/course/session/shortanswer/delete/{id}")
  * @ApiDoc(
  *  resource=true,
  *  description="Update Short answer question",
  *  requirements={
  *      {"name"="id", "dataType"="string", "requirement"="true", "description"="question's id"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *      {"name"="sessionid", "dataType"="string", "requirement"="true", "description"="session's id"}
  *  }
  * )
  */
  public function deleteShortanswerActionAction(Request $request,$id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $shortanswer = $em->getRepository('CoreBundle:Shortanswer')->findOneById($id);
    if ( !$shortanswer ) {
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
      $em->remove($shortanswer);
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
