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
   * @Route("/images")
   */
    public function getImages()
  {

      $result = '{"code":0,"message":"succeed!",
                "result":{
                  "list":[ <br>
                         {"id" : 1, "image_url" : "http://pic250.quanjing.com/imageclk008/ic01810156.jpg" } <br>
                         {"id" : 2, "image_url" : "http://www.52tian.net/file/image/20150531/2015053115380974974.jpg" }<br>
                         {"id" : 3, "image_url" : "http://cdn.duitang.com/uploads/item/201509/27/20150927191624_2tnMS.thumb.224_0.jpeg" }<br>
                         {"id" : 4, "image_url" : "http://d.hiphotos.baidu.com/zhidao/pic/item/622762d0f703918f331290f3523d269758eec4cc.jpg" }<br>
                         {"id" : 5, "image_url" : "http://img5.duitang.com/uploads/item/201410/03/20141003114818_n4mE5.jpeg" }<br>
                         {"id" : 6, "image_url" : "http://h.hiphotos.baidu.com/zhidao/pic/item/eac4b74543a9822628850ccc8c82b9014b90eb91.jpg" }<br>
                         {"id" : 7, "image_url" : "http://cdn.duitang.com/uploads/item/201506/19/20150619104259_YnzER.jpeg" }<br>
                         {"id" : 8, "image_url" : "http://img.woyaogexing.com/2016/03/20/8f7f6f3075ea8050!200x200.jpg" }<br>
                         {"id" : 9, "image_url" : "http://img.woyaogexing.com/2016/03/20/7aaecef8aa510125!200x200.jpg" }<br>
                         {"id" : 10, "image_url" : "http://img.woyaogexing.com/2016/03/15/931531707bb7cdf8!200x200.jpg" }<br>
                         {"id" : 11, "image_url" : "http://img.woyaogexing.com/2016/03/12/1f5c35c1a56ad418!200x200.jpg" }<br>
                         {"id" : 12, "image_url" : "http://img.woyaogexing.com/2016/03/11/8102f9f919664810!200x200.jpg" }<br>
                         {"id" : 13, "image_url" : "http://img.woyaogexing.com/2016/03/09/d4dd7a8891d0d1bf!200x200.jpg" }<br>
                         {"id" : 14, "image_url" : "http://img.woyaogexing.com/2016/03/10/3e65faa311ff50a9!200x200.jpg" }<br>
                         {"id" : 15, "image_url" : "http://img5.imgtn.bdimg.com/it/u=2436748548,3043034109&fm=21&gp=0.jpg" }<br>
                         {"id" : 16, "image_url" : "http://img5.imgtn.bdimg.com/it/u=712125071,2979616932&fm=21&gp=0.jpg" }<br>
                         {"id" : 17, "image_url" : "http://img0.imgtn.bdimg.com/it/u=4009647627,32434083&fm=21&gp=0.jpg" }<br>
                         {"id" : 18, "image_url" : "http://img4.imgtn.bdimg.com/it/u=3094644708,1255791626&fm=21&gp=0.jpg" }<br>
                         {"id" : 19, "image_url" : "http://img3.imgtn.bdimg.com/it/u=3399801391,4100922036&fm=21&gp=0.jpg" }<br>
                         {"id" : 20, "image_url" : "http://img1.imgtn.bdimg.com/it/u=1885773962,779842625&fm=21&gp=0.jpg" }
                  ]
                }
               }';   
      return new Response( $result );           
  }

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
      $coin = $user->getCoin();

      $photo = $account && $account->getPhoto() ? $account->getPhoto() : 'http://img4.imgtn.bdimg.com/it/u=172112303,3232882607&fm=21&gp=0.jpg';
      $name = $account && $account->getName() ? $account->getName() : '傻头傻脑';
      $signature = $account && $account->getSignature() ? $account->getSignature() : '';
      $phoneNumber = $account && $account->getPhonenumber() ? $account->getPhonenumber() : '';
      $otherNumber = $account && $account->getOthernumber() ? $account->getOthernumber() : '';

      $balance = $coin && $coin->getBalance() ? $coin->getBalance() :'0';
      $number = $coin && $coin->getNumber() ? $coin->getNumber():'0';
      
      $userCreatedAt = $user->getCreatedAt()->format('Y-m-d H:i:s');

      $content = sprintf('{"photo":"%s","name":"%s","signature":"%s","balance":"%s","number":"%s","phoneNumber":"%s","createdAt":"%s","otherNumber":"%s"}'
                         , $photo, $name, $signature, $balance, $number, $phoneNumber, $userCreatedAt, $otherNumber);
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
}

     
     
      