<?php

namespace Acme\Bundle\BlogBundle\Controller;

use Acme\Bundle\BlogBundle\Entity\Classes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClassesController extends Controller
{
   private function getMenuTreeAction($arrCat, $parent_id = 0, $level = 0){
        static  $arrTree = array();
        if( empty($arrCat))
        { return false;}
        $level++;
        foreach($arrCat as $key => $value){
           if($value->getPId() == $parent_id){
                $value->level = $level;
                $arrTree[] = $value;
                unset($arrCat[$key]); //注销当前节点数据，减少已无用的遍历
                $this->getMenuTreeAction($arrCat, $value->getId(), $level);
            }
        }
        return $arrTree;
    }
    /**
    * @Template()
    */
   public function indexAction(){
        $em=$this->getDoctrine()->getManager();
        $menu=$em->getRepository('AcmeBlogBundle:Classes')->findAll();

        #print_r($this->getMenuTreeAction($menu));
        #exit;
        $classes = $this->getMenuTreeAction($menu);
        return array('classes' => $classes);
    }
}
