<?php

namespace ApiBundle\Controller;

use CoreBundle\Entity\Course;


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


class CourseController extends Controller
{

  /**
  * Get list of courses
  * @Get("/course/get/{id}")
  * @ApiDoc(
  *  resource=true,
  *  description="Get course information"
  * )
  */
  public function getCourseAction($id)
  {
    $jsonResponse = new JsonResponse();
    $em = $this->getDoctrine()->getManager();
    $query  = $em->createQuery("
    SELECT c.id,c.code,c.teacher,c.email,c.year,c.period,c.accesscode,c.language
    FROM CoreBundle\Entity\Course c
    WHERE  c.id = :id")
    ->setParameter('id', $id);
    try {
      $course = $query->getSingleResult();
      return $course;
    }
    catch (\Doctrine\ORM\NoResultException $e) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"No existe un Curso con el código solicitado"
      ));
      return $jsonResponse;
    }
  }

  /**
  * POST a Course
  * @POST("/course/add")
  * @ApiDoc(
  *  resource=true,
  *  description="Add course",
  *  requirements={
  *      {"name"="code", "dataType"="string", "requirement"="true", "description"="Course code"},
  *      {"name"="teacher", "dataType"="string", "requirement"="true", "description"="ID teacher"},
  *      {"name"="email", "dataType"="string", "requirement"="true", "description"="teacher email"},
  *      {"name"="year", "dataType"="string", "requirement"="true", "description"="Course is year"},
  *      {"name"="period", "dataType"="string", "requirement"="true", "description"="Course is period"},
  *      {"name"="accesscode", "dataType"="string", "requirement"="true", "description"="Course is access code"},
  *      {"name"="language", "dataType"="string", "requirement"="true", "description"="Course's language"}
  *  }
  * )
  */
  public function addCourseAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $jsonResponse = new JsonResponse();

    if ($request->getMethod() == 'POST') {
      $code = $request->request->get('code');
      $teacher = $request->request->get('teacher');
      $email = $request->request->get('email');
      $year = $request->request->get('year');
      $period = $request->request->get('period');
      $accesscode = $request->request->get('accesscode');
      $language = $request->request->get('language');
    }


    //Check if Course exists
    $oldcourse = $em->getRepository('CoreBundle:Course')->findOneBy(array('code' => $code,'teacher' => $teacher, 'year' => $year, 'period' => $period));
    if($oldcourse) {
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"El Curso ya se encuentra registrado para el presente periodo y docente (Fecha:".$oldcourse->getCreatedat()->format('d-m-Y').")"
      ));
      return $jsonResponse;
    }

    try {
      $course = new Course();
      $course->setCode($code);
      $course->setTeacher($teacher);
      $course->setEmail($email);
      $course->setYear($year);
      $course->setPeriod($period);
      $course->setAccesscode($accesscode);
      $course->setLanguage($language);

      $course->setCreatedAt(new \DateTime("now"));
      $em->persist($course);
      $em->flush();

      $jsonResponse->setData(array(
        "type" => "success",
        "message"=>"ok",
        "courseid" => $course->getId()
      ));

    } catch(\Doctrine\ORM\ORMException $e){
      $jsonResponse->setData(array(
        "type" => "error",
        "message"=>"Error: Problem with Courseid"
      ));
    }
    return $jsonResponse;
  }

}
