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
    public function getAvailableQuestionAction($id)
    {
          $jsonResponse = new JsonResponse();
          $em = $this->getDoctrine()->getManager();
          $course = $em->getRepository('CoreBundle:Course')->findOneBy(array('id' => $id));
          if (!$course) {
              $jsonResponse->setData(array(
                  "type" => "error",
                  "message"=>"No existe un Curso con el código solicitado"
              ));
              return $jsonResponse;
          }
          else {
		return $course;
          }
    }


    

}
