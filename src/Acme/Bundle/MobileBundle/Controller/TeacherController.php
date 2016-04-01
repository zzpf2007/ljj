<?php

namespace Acme\Bundle\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherController extends Controller
{
  /**
   * @Route("/teachers")
   */
 public function indexAction(Request $request)
    {
    
      $em = $this->getDoctrine()->getManager();
      $teachers = $em->getRepository('AppBundle:Teacher')->findAll();
      $lst = array();

      foreach($teachers as $key => $teacher)
      {
        $lst[] = sprintf('{"id":"%s","name":"%s","photo":"%s","major":"%s","exp":"%s"}', 

            $teacher->getId(), 
            $teacher->getName(), 
            $teacher->getPhoto(), 
            $teacher->getMajor(),
            $teacher->getExp() 
        );
      }

      $content = sprintf('{"code":0,"message":"succeed!","result":{"list":[%s]}}', implode(',', $lst));
       
      return new Response($content);
    }

    /**
   * @Route("/teachers/{id}")
   */
  public function accountAction( Request $request, $id)
  {
    $content = "";

    if ( $id ) {
      $em = $this->getDoctrine()->getManager();
      $teacher = $em->getRepository('AppBundle:Teacher')->find($id);
    }

    if ( $teacher ) {
      $courses = $teacher->getCourse();

      $id = $teacher->getId();
      $name = $teacher->getName();
      $photo = $teacher->getPhoto();
      $major = $teacher->getMajor();
      $duration = $teacher->getDuration();
      $exp = $teacher->getExp();
      

      if($courses){

        $lst = array();
        
        foreach($courses as  $key => $course){
            $lst[] = sprintf('{"id" : "%s", "title" : "%s","photo":"%s","duration":"%s","tcvideourl":"%s"}', 
                              $course->getId(),
                              $course->getTitle(),
                              $course->getPhoto(),
                              $course->getDuration(),
                              $course->getTcVideoUrl()

            );
            }

        $content = sprintf('{"code":0,"message":"succeed!","result":{"id":"%s","name":"%s","photo":"%s","major":"%s","duration":"%s","exp":"%s","list":[%s]}}',$id,$name,$photo,$major,$duration,$exp ,implode(',', $lst));
        //$content = sprintf('{"code":0,"message":"succeed!","result":{"list":[%s]}}', implode(',', $lst));
      }
      return new Response( $content );
    }  
  }
}