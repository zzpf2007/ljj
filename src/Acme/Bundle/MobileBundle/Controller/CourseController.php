<?php

namespace Acme\Bundle\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
 /**
   * @Route("/school/course/{id}")
   */
  public function accountAction( Request $request, $id)
  {
      $content = "";

      if ( $id ) {
        $em = $this->getDoctrine()->getManager();
        $course = $em->getRepository('AppBundle:Course')->find($id);
      }

      if ( $course ) {

        $items = $course->getItem();

        if($items){
          $lst = array();

          foreach($items as  $key => $item){
              $lst[] = sprintf('{"id" : "%s", "title" : "%s","photo":"%s","duration":"%s","tcvideourl":"%s"}', 
                                $item->getId(),
                                $item->getTitle(),
                                $item->getPhoto(),
                                $item->getDuration(),
                                $item->getTcVideoUrl()
              );
          }

          $content = sprintf('{"result":[%s]}', implode(',', $lst));
          //$content = sprintf('{"code":0,"message":"succeed!","result":{"list":[%s]}}', implode(',', $lst));
        }
        return new Response( $content );
      }  
  }
  
  /**
   * @Route("/courses")
   */
  public function courseAction( Request $request)
  {
          $result = '';
          $result = '{"code":0,"message":"succeed!",';
          $result .= '"result":{';
          $result .= '"list":[';
          $result .= '{"id":1,"title":"HTML/CSS","contentcount":"31","photo":"http://ljj.cn/img/photo_3.png","teacher":"房森","type":"0","tcvideo":""},';
          $result .= '{"id":2,"title":"Javascript","contentcount":"45","photo":"http://ljj.cn/img/photo_2.png","teacher":"吴兆辉","type":"0","tcvideo":""},';
          $result .= '{"id":3,"title":"jQuery","contentcount":"23","photo":"http://ljj.cn/img/photo_5.png","teacher":"王东羽","type":"0","tcvideo":""},';
          $result .= '{"id":4,"title":"bootstrap","contentcount":"36","photo":"http://ljj.cn/img/photo_3.png","teacher":"房森","type":"1","tcvideo":""},';
          $result .= '{"id":5,"title":"node.JS","contentcount":"56","photo":"http://ljj.cn/img/photo_4.png","teacher":"sherry","type":"1","tcvideo":""},';
          $result .= '{"id":6,"title":"Ajax","contentcount":"31","photo":"http://ljj.cn/img/photo_6.png","teacher":"李长宸","type":"0","tcvideo":""},';
          $result .= '{"id":7,"title":"HTML5","contentcount":"31","photo":"http://ljj.cn/img/photo_1.png","teacher":"杜明坦","type":"0","tcvideo":""}';
          $result .= ']}}';

          return new Response($result);
  }

  /**
   * @Route("/all/courses")
   */
  public function coursesAction( Request $request)
  {
      $em = $this->getDoctrine()->getManager();
      $teachers = $em->getRepository('AppBundle:Teacher')->findAll();

      $em = $this->getDoctrine()->getManager();
      $courses = $em->getRepository('AppBundle:Course')->findAll();

      $top = array();

      foreach ($teachers as $teacher) {

          $sub = array();
          $courses = $teacher->getCourse();

          foreach ($courses as $course) {
            
             $sub[] = sprintf('{"id":"%s","title":"%s","photo":"%s","duration":"%s","tcvideourl":"%s","teacher":"%s"}', $course->getId(), $course->getTitle(), $course->getPhoto(),$course->getDuration(), $course->gettcVideoUrl(),$teacher->getName());
          }
          
             $top[] = sprintf('{ "courses":[%s]}', implode(',', $sub));

      }

      $result = '{"result": ['. implode(',', $top) .']}';
      
      return new Response($result);
    
  }

}