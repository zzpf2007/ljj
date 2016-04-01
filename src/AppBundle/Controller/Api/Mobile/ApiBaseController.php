<?php

namespace AppBundle\Controller\Api\Mobile;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Utility\WebApi\WebApiFactory;
use AppBundle\Utility\Check\CheckString;
use AppBundle\Utility\WebApi\User\UserApiFactory;
use AppBundle\Utility\WebApi\User\UserApiUtil;

class ApiBaseController extends Controller
{
    public function userAction(Request $request)
    {
      $result = '';

      list( $type, $data ) = UserApiUtil::buildRequest( $request );

      $logger = $this->get('my_service.logger');
      $logger->debug( date('Y-m-d H:i:s') );
      $logger->debug( urldecode( $request->getQueryString() ) );

      // var_dump( urldecode( $request->getQueryString() ) );
      // print urldecode( $request->getQueryString() );
      $webApi = UserApiFactory::getInstance( $type, $data, $this->container );
      $result = $webApi->getResult();


      return new Response($result);
    }

    public function categoryActoin(Request $request, $id)
    {
      $webApi = WebApiFactory::getInstance('categories', $this->container, $id );
      $result = '';
      $result = '{"code":0,"message":"succeed!",';
      $result .= '"result":{';
      $result .= '"list":[';

      if($id == 1){
          $result .= '{"id":1,"title":"HTML/CSS","contentcount":"31","photo":"http://ljj.cn/img/photo_3.png","teacher":"房森"},';
          $result .= '{"id":2,"title":"Javascript","contentcount":"45","photo":"http://ljj.cn/img/photo_2.png","teacher":"吴兆辉"},';
          $result .= '{"id":3,"title":"jQuery","contentcount":"23","photo":"http://ljj.cn/img/photo_5.png","teacher":"王东羽"},';
          $result .= '{"id":4,"title":"bootstrap","contentcount":"36","photo":"http://ljj.cn/img/photo_3.png","teacher":"房森"},';
          $result .= '{"id":5,"title":"node.JS","contentcount":"56","photo":"http://ljj.cn/img/photo_4.png","teacher":"sherry"},';
          $result .= '{"id":6,"title":"Ajax","contentcount":"31","photo":"http://ljj.cn/img/photo_6.png","teacher":"李长宸"},';
          $result .= '{"id":7,"title":"HTML5","contentcount":"31","photo":"http://ljj.cn/img/photo_1.png","teacher":"杜明坦"}';
          
      }elseif($id == 2){
        $result .= '{"id":1,"title":"HTML/CSS","contentcount":"31","photo":"http://ljj.cn/img/photo_3.png","teacher":"房森"},';
        $result .= '{"id":3,"title":"jQuery","contentcount":"23","photo":"http://ljj.cn/img/photo_5.png","teacher":"王东羽"},';
        $result .= '{"id":5,"title":"node.JS","contentcount":"56","photo":"http://ljj.cn/img/photo_4.png","teacher":"sherry"},';
        $result .= '{"id":7,"title":"HTML5","contentcount":"31","photo":"http://ljj.cn/img/photo_1.png","teacher":"杜明坦"}';
      }elseif($id == 3){
        $result .= '{"id":2,"title":"Javascript","contentcount":"45","photo":"http://ljj.cn/img/photo_2.png","teacher":"吴兆辉"},';
        $result .= '{"id":4,"title":"bootstrap","contentcount":"36","photo":"http://ljj.cn/img/photo_3.png","teacher":"房森"},'; 
        $result .= '{"id":6,"title":"Ajax","contentcount":"31","photo":"http://ljj.cn/img/photo_6.png","teacher":"李长宸"}';
      }elseif($id == 4){
        $result .= '{"id":5,"title":"node.JS","contentcount":"56","photo":"http://ljj.cn/img/photo_4.png","teacher":"sherry"},';
        $result .= '{"id":6,"title":"Ajax","contentcount":"31","photo":"http://ljj.cn/img/photo_6.png","teacher":"李长宸"},';
        $result .= '{"id":7,"title":"HTML5","contentcount":"31","photo":"http://ljj.cn/img/photo_1.png","teacher":"杜明坦"}';
      }elseif($id == 5){
        $result .= '{"id":1,"title":"HTML/CSS","contentcount":"31","photo":"http://ljj.cn/img/photo_3.png","teacher":"房森"},';
        $result .= '{"id":2,"title":"Javascript","contentcount":"45","photo":"http://ljj.cn/img/photo_2.png","teacher":"吴兆辉"},';
        $result .= '{"id":3,"title":"jQuery","contentcount":"23","photo":"http://ljj.cn/img/photo_5.png","teacher":"王东羽"},';
        $result .= '{"id":4,"title":"bootstrap","contentcount":"36","photo":"http://ljj.cn/img/photo_3.png","teacher":"房森"}';
      }elseif($id == 6){
        $result .= '{"id":1,"title":"HTML/CSS","contentcount":"31","photo":"http://ljj.cn/img/photo_3.png","teacher":"房森"},';
        $result .= '{"id":5,"title":"node.JS","contentcount":"56","photo":"http://ljj.cn/img/photo_4.png","teacher":"sherry"},';
        $result .= '{"id":6,"title":"Ajax","contentcount":"31","photo":"http://ljj.cn/img/photo_6.png","teacher":"李长宸"},';
        $result .= '{"id":7,"title":"HTML5","contentcount":"31","photo":"http://ljj.cn/img/photo_1.png","teacher":"杜明坦"}';
      }elseif($id == 7){
        $result .= '{"id":1,"title":"HTML/CSS","contentcount":"31","photo":"http://ljj.cn/img/photo_3.png","teacher":"房森"},';
        $result .= '{"id":2,"title":"Javascript","contentcount":"45","photo":"http://ljj.cn/img/photo_2.png","teacher":"吴兆辉"}';
      }
      else{
        $result .= '{"id":6,"title":"Ajax","contentcount":"31","photo":"http://ljj.cn/img/photo_6.png","teacher":"李长宸"},';
        $result .= '{"id":7,"title":"HTML5","contentcount":"31","photo":"http://ljj.cn/img/photo_1.png","teacher":"杜明坦"}';
      }
      $result .= ']}}';
      //$result = $webApi->getResult();
      return new Response(CheckString::check( $result ));
    }

    public function courseAction(Request $request, $id)
    {
      $webApiCourse = WebApiFactory::getInstance('course', $this->container, $id );
      $result = $webApiCourse->getResult();
      return new Response(CheckString::check( $result ));
    }
}
