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

    /**
     * @Route("/search/{title}")
     */
      public function searchAction(Request $request,$title)
      {  
            
           $content = ''; 

           if($title)
           {
                 $em = $this->getDoctrine()->getManager();
                 $query = $em->createQuery(   
                 'SELECT u FROM AppBundle:Course u WHERE u.title LIKE :title ORDER BY u.id DESC'   
                 )->setParameter('title','%'.$title.'%');   
               
                 $results = $query->getResult(); 

                 //var_dump($results);die;

                 $lst[] = array();

                 foreach( $results as $key => $result ){

                  //var_dump($result);die;

                   $lst[] = sprintf('{"id":"%s","title":"%s","photo":"%s","price":"%s"}',
                          $result->getId(),
                          $result->getTitle(),
                          $result->getPhoto(),
                          $result->getPrice()
                   );        
                 }

 
                 $em = $this->getDoctrine()->getManager();
                 $query = $em->createQuery(   
                 'SELECT u FROM AppBundle:Teacher u WHERE u.name LIKE :name ORDER BY u.id DESC'   
                 )->setParameter('name','%'.$title.'%');   
               
                 $result = $query->getResult(); 

                 //var_dump($results);die;

                 $list[] = array();

                 foreach( $result as $key => $resul ){

                  //var_dump($result);die;

                   $list[] = sprintf('{"id":"%s","name":"%s","major":"%s","photo":"%s","duration":"%s","exp":"%s"}',
                          $resul->getId(),
                          $resul->getName(),
                          $resul->getMajor(),
                          $resul->getPhoto(),
                          $resul->getDuration(),
                          $resul->getExp()
                   );        
                 }
                   
              
                 $content = sprintf('{"course":[%s],"teacher":[%s]}',implode(',', array_filter($lst)),implode(',', array_filter($list)));
           
            } 

            return new Response( $content );            
      }



}