<?php

namespace Acme\Bundle\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

  /**
   * @Route("/info/{id}")
   */
  public function accountAction( Request $request, $id)
  {
    $content = "";
    if ( $id ) {
      $em = $this->getDoctrine()->getManager();
      $user = $em->getRepository('AppBundle:User')->find($id);
    }
    if ( $user ) {
      $account = $user->getAccount();

      $name = $account && $account->getName() ? $account->getName() : '傻头傻脑';
      $photo = $account && $account->getPhoto() ? $account->getPhoto() : 'http://img4.imgtn.bdimg.com/it/u=172112303,3232882607&fm=21&gp=0.jpg';  
      $signature = $account && $account->getSignature() ? $account->getSignature() : '';
      $phoneNumber = $user->getUsername();
      $otherNumber = $account && $account->getOthernumber() ? $account->getOthernumber() : '';
      $balance = $account && $account->getBalance() ? $account->getBalance() :'0.00';
      $number = $account && $account->getNumber() ? $account->getNumber():'0';
      
      $userCreatedAt = $user->getCreatedAt()->format('Y-m-d H:i:s');

      $content = sprintf('{"name":"%s","photo":"%s","signature":"%s","phoneNumber":"%s","otherNumber":"%s","balance":"%s","number":"%s","createdAt":"%s"}'
                         , $name, $photo, $signature, $phoneNumber, $otherNumber, $balance, $number, $userCreatedAt);
    }
    return new Response( $content );
  }


  /**
   * @Route("/sign/{id}")
   */
  public function signAction( Request $request, $id)
  {
    $content = "";
    if ( $id ) {
      $em = $this->getDoctrine()->getManager();
      $user = $em->getRepository('AppBundle:User')->find($id);
    }
    if ( $user ) {

      $account = $user->getAccount();
     
      $signin = $account && $account->getSignin() ? getSignin() :'0';
      $content = sprintf('{"code":0,"message":"succeed!","result":{"signin":"%s"} }'
                        , $signin);
    }
    return new Response( $content );
  }
  
  /**
   * @Route("/coupons/{id}")
   */
  public function couponsAction( Request $request, $id)
  {
    $content = "";
    if ( $id ) {
      $em = $this->getDoctrine()->getManager();
      $user = $em->getRepository('AppBundle:User')->find($id);
    }
    if ( $user ) {
       $coupons = $user->getCoupons();

       if($coupons){

       $lst = array();

      foreach($coupons as  $key => $coupon){
        
         $lst[] = sprintf('{"id" : "%s", "amount" : "%s", "species" : "%s", "minmoney" : "%s", "time" : "%s" }', 
           
           $coupon->getId(),
           $coupon->getAmount(),
           $coupon->getSpecies(),
           $coupon->getMinmoney(),
           $coupon->getTime()

          );
      }

      $content = sprintf('{"code":0,"message":"succeed!","result":{"list":[%s]}}', implode(',', $lst));
      //$content = sprintf('{"code":0,"message":"succeed!","result":{"list":[%s]}}', implode(',', $lst));
    }
    return new Response( $content );
  }
}

    /**
   * @Route("/messages/{id}")
   */
  public function messagesAction( Request $request, $id)
  {
    $content = "";
    if ( $id ) {
      $em = $this->getDoctrine()->getManager();
      $user = $em->getRepository('AppBundle:User')->find($id);
    }
    if ( $user ) {

       $messages = $user->getMessage();

       if($messages){

       $lst = array();

      foreach($messages as  $key => $message){
        
         $lst[] = sprintf('{"id" : "%s", "content" : "%s", "time" : "%s" }', 
           
           $message->getId(),
           $message->getContent(),
           $message->getTime()->format("Y-m-d H:i:s")

          );
      }

      $content = sprintf('{"code":0,"message":"succeed!","result":{"list":[%s]}}', implode(',', $lst));
      //$content = sprintf('{"code":0,"message":"succeed!","result":{"list":[%s]}}', implode(',', $lst));
    }
    return new Response( $content );
  }
}

 /**
   * @Route("/courses/{id}")
   */
  public function coursesAction( Request $request, $id)
  {
    $content = "";
    if ( $id ) {
      $em = $this->getDoctrine()->getManager();
      $user = $em->getRepository('AppBundle:User')->find($id);
    }
    if ( $user ) {

       $courses = $user->getCourse();

       if($courses){

       $lst = array();

      foreach($courses as  $key => $course){
        
         $lst[] = sprintf('{"id" : "%s", "title" : "%s", "photo" : "%s", "duration" : "%s", "tcvideourl" : "%s"}', 
           
           $course->getId(),
           $course->getTitle(),
           $course->getPhoto(),
           $course->getDuration(),
           $course->getTcVideoUrl()

          );
      }

      $content = sprintf('{"code":0,"message":"succeed!","result":{"list":[%s]}}', implode(',', $lst));
      //$content = sprintf('{"code":0,"message":"succeed!","result":{"list":[%s]}}', implode(',', $lst));
    }
    return new Response( $content );
  }
}


  /**
   * @Route("/rember")
   */
  public function remberAction( Request $request)
  {
           function GetRandStr($len) 
        { 
            $chars = array( 
                "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  
                "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",  
                "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",  
                "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",  
                "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",  
                "3", "4", "5", "6", "7", "8", "9" 
            ); 
            $charsLen = count($chars) - 1; 
            shuffle($chars);   
            $output = ""; 
            for ($i=0; $i<$len; $i++) 
            { 
                $output .= $chars[mt_rand(0, $charsLen)]; 
            }  
            return $output;  
        } 
         // echo GetRandStr(4);
        $token = GetRandStr(10);
        return new Response($token);
  }
  


}

     
     
      