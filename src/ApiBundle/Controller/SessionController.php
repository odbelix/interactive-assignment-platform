<?php

namespace ApiBundle\Controller;

use CoreBundle\Entity\Course;
use CoreBundle\Entity\Session;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
//REST
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
//For documentation path
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use UbiAppStatsBundle\Entity\ServiceStat;


class SessionController extends Controller
{

  /**
  * Get list of sessions
  * @Get("/course/{id}/get/sessions")
  * @ApiDoc(
  *  resource=true,
  *  description="Get course information"
  * )
  */
  public function getCourseSessionsAction($id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $query  = $em->createQuery("
    SELECT s.id,s.title,s.detail,s.createdat,s.finishedat,s.order,s.course_id
    FROM CoreBundle\Entity\Session s
    WHERE  s.course_id = :id")
    ->setParameter('id', $id);
    try {
      $sessions = $query->getResult();
      if (  count($sessions) == 0 ){
        $jsonResponse->setData(array(
          "type" => "error",
          "message"=>"No existen sesiones para el curso solicitado"
        ));
      }
      else {
        return $sessions;
      }
    }
    catch (\Doctrine\ORM\NoResultException $e) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"No existen sesiones para el curso solicitado"
      ));
    }
    return $jsonResponse;
  }


  /**
  * Get session
  * @Get("/course/session/get/{id}")
  * @ApiDoc(
  *  resource=true,
  *  description="Get session information"
  * )
  */
  public function getCourseSessionAction($id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $query  = $em->createQuery("
    SELECT s.id,s.title,s.detail,s.createdat,s.finishedat,s.order,s.course_id
    FROM CoreBundle\Entity\Session s
    WHERE  s.id = :id")
    ->setParameter('id', $id);
    try {
      $session = $query->getSingleResult();
      return $session;
    }
    catch (\Doctrine\ORM\NoResultException $e) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"No existen la sesión para el identificador solicitado"
      ));
    }
    return $jsonResponse;
  }



  /**
  * Close session
  * @Get("/course/session/close/{id}")
  * @ApiDoc(
  *  resource=true,
  *  description="Close session"
  * )
  */
  public function getCourseSessionCloseAction($id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $session = $em->getRepository('CoreBundle:Session')->findOneById($id);
    if (!$session ) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"No existen la sesión para el identificador solicitado"
      ));
    }
    else {
      $session->setFinishedAt(new \DateTime("now"));
      $em->persist($session);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"close",
        "sessionid" => $session->getId()
      ));
    }
    return $jsonResponse;
  }



  /**
  * Add a Session
  * @POST("/course/session/add")
  * @ApiDoc(
  *  resource=true,
  *  description="Add Session",
  *  requirements={
  *      {"name"="title", "dataType"="string", "requirement"="true", "description"="session's title"},
  *      {"name"="detail", "dataType"="string", "requirement"="true", "description"="session's detail"},
  *      {"name"="order", "dataType"="string", "requirement"="true", "description"="sessions'order"},
  *      {"name"="courseid", "dataType"="string", "requirement"="true", "description"="course's id"},
  *  }
  * )
  */
  public function addSessionAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $jsonResponse = new JsonResponse();

    if ($request->getMethod() == 'POST') {
      $title = $request->request->get('title');
      $detail = $request->request->get('detail');
      $order = $request->request->get('order');
      $courseid = $request->request->get('courseid');
      $course = $em->getRepository('CoreBundle:Course')->findOneById($courseid);
    }

    try {

      $session = new Session();
      $session->setTitle($title);
      $session->setDetail($detail);
      $session->setOrder($order);
      $session->setCourse($course);
      $session->setCreatedAt(new \DateTime("now"));
      $em->persist($session);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"ok",
        "sessionid" => $session->getId()
      ));

    } catch(\Doctrine\ORM\ORMException $e){
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: Problem with Sessionid"
      ));
    }
    return $jsonResponse;
  }

}
