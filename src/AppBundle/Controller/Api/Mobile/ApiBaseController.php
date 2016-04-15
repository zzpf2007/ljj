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
          $result .= '{"id":1,"title":"HTML/CSS","contentcount":"31","photo":"http://www.html5cn.org/data/attachment/portal/201603/08/161339h9xbdqx2ggzqmuqy.jpg","teacher":"房森"},';
          $result .= '{"id":2,"title":"Javascript","contentcount":"45","photo":"http://m.tiebaimg.com/timg?wapp&quality=80&size=b150_150&subsize=20480&cut_x=0&cut_w=0&cut_y=0&cut_h=0&sec=1369815402&srctrace&di=ee77b5eebfb22fefafaf2c4e0b8fa9f8&wh_rate=null&src=http%3A%2F%2Fimgsrc.baidu.com%2Fforum%2Fpic%2Fitem%2Fb58f8c5494eef01f70276779e1fe9925bc317d5e.jpg","teacher":"吴兆辉"},';
          $result .= '{"id":3,"title":"jQuery","contentcount":"23","photo":"http://static.bootcss.com/www/assets/img/jqueryapi.png","teacher":"王东羽"},';
          $result .= '{"id":4,"title":"bootstrap","contentcount":"36","photo":"http://static.bootcss.com/www/assets/img/codeguide.png","teacher":"房森"},';
          $result .= '{"id":5,"title":"node.JS","contentcount":"56","photo":"http://www.nodejs.net/upload_files/2013/01/about_reds.jpg","teacher":"sherry"},';
          $result .= '{"id":6,"title":"Ajax","contentcount":"31","photo":"http://m.tiebaimg.com/timg?wapp&quality=80&size=b150_150&subsize=20480&cut_x=0&cut_w=0&cut_y=0&cut_h=0&sec=1369815402&srctrace&di=3023252be28e87eddcba81adacfcb37e&wh_rate=null&src=http%3A%2F%2Fimgsrc.baidu.com%2Fforum%2Fpic%2Fitem%2F34fae6cd7b899e515938814643a7d933c8950d29.jpg","teacher":"李长宸"},';
          $result .= '{"id":7,"title":"HTML5","contentcount":"31","photo":"http://www.jywbphp.com/uploads/141115/1-141115150ZR49.jpg","teacher":"杜明坦"}';
          
      }elseif($id == 2){
        $result .= '{"id":1,"title":"HTML/CSS","contentcount":"31","photo":"http://www.html5cn.org/data/attachment/portal/201603/08/161339h9xbdqx2ggzqmuqy.jpg","teacher":"房森"},';
        $result .= '{"id":3,"title":"jQuery","contentcount":"23","http://static.bootcss.com/www/assets/img/jqueryapi.png","teacher":"王东羽"},';
        $result .= '{"id":5,"title":"node.JS","contentcount":"56","photo":"http://www.nodejs.net/upload_files/2013/01/about_reds.jpg","teacher":"sherry"},';
        $result .= '{"id":7,"title":"HTML5","contentcount":"31","photo":"http://www.jywbphp.com/uploads/141115/1-141115150ZR49.jpg","teacher":"杜明坦"}';
      }elseif($id == 3){
        $result .= '{"id":2,"title":"Javascript","contentcount":"45","http://m.tiebaimg.com/timg?wapp&quality=80&size=b150_150&subsize=20480&cut_x=0&cut_w=0&cut_y=0&cut_h=0&sec=1369815402&srctrace&di=ee77b5eebfb22fefafaf2c4e0b8fa9f8&wh_rate=null&src=http%3A%2F%2Fimgsrc.baidu.com%2Fforum%2Fpic%2Fitem%2Fb58f8c5494eef01f70276779e1fe9925bc317d5e.jpg","teacher":"吴兆辉"},';
        $result .= '{"id":4,"title":"bootstrap","contentcount":"36","photo":"http://static.bootcss.com/www/assets/img/codeguide.png","teacher":"房森"},'; 
        $result .= '{"id":6,"title":"Ajax","contentcount":"31","photo":"http://m.tiebaimg.com/timg?wapp&quality=80&size=b150_150&subsize=20480&cut_x=0&cut_w=0&cut_y=0&cut_h=0&sec=1369815402&srctrace&di=3023252be28e87eddcba81adacfcb37e&wh_rate=null&src=http%3A%2F%2Fimgsrc.baidu.com%2Fforum%2Fpic%2Fitem%2F34fae6cd7b899e515938814643a7d933c8950d29.jpg","teacher":"李长宸"}';
      }elseif($id == 4){
        $result .= '{"id":5,"title":"node.JS","contentcount":"56","photo":"http://www.nodejs.net/upload_files/2013/01/about_reds.jpg","teacher":"sherry"},';
        $result .= '{"id":6,"title":"Ajax","contentcount":"31","photo":"http://m.tiebaimg.com/timg?wapp&quality=80&size=b150_150&subsize=20480&cut_x=0&cut_w=0&cut_y=0&cut_h=0&sec=1369815402&srctrace&di=3023252be28e87eddcba81adacfcb37e&wh_rate=null&src=http%3A%2F%2Fimgsrc.baidu.com%2Fforum%2Fpic%2Fitem%2F34fae6cd7b899e515938814643a7d933c8950d29.jpg","teacher":"李长宸"},';
        $result .= '{"id":7,"title":"HTML5","contentcount":"31","photo":"http://www.jywbphp.com/uploads/141115/1-141115150ZR49.jpg","teacher":"杜明坦"}';
      }elseif($id == 5){
        $result .= '{"id":1,"title":"HTML/CSS","contentcount":"31","photo":"http://www.html5cn.org/data/attachment/portal/201603/08/161339h9xbdqx2ggzqmuqy.jpg","teacher":"房森"},';
        $result .= '{"id":2,"title":"Javascript","contentcount":"45","photo":"http://m.tiebaimg.com/timg?wapp&quality=80&size=b150_150&subsize=20480&cut_x=0&cut_w=0&cut_y=0&cut_h=0&sec=1369815402&srctrace&di=ee77b5eebfb22fefafaf2c4e0b8fa9f8&wh_rate=null&src=http%3A%2F%2Fimgsrc.baidu.com%2Fforum%2Fpic%2Fitem%2Fb58f8c5494eef01f70276779e1fe9925bc317d5e.jpg","teacher":"吴兆辉"},';
        $result .= '{"id":3,"title":"jQuery","contentcount":"23","photo":"http://static.bootcss.com/www/assets/img/jqueryapi.png","teacher":"王东羽"},';
        $result .= '{"id":4,"title":"bootstrap","contentcount":"36","photo":"http://static.bootcss.com/www/assets/img/codeguide.png","teacher":"房森"}';
      }elseif($id == 6){
        $result .= '{"id":1,"title":"HTML/CSS","contentcount":"31","photo":"http://www.html5cn.org/data/attachment/portal/201603/08/161339h9xbdqx2ggzqmuqy.jpg","teacher":"房森"},';
        $result .= '{"id":5,"title":"node.JS","contentcount":"56","photo":"http://www.nodejs.net/upload_files/2013/01/about_reds.jpg","teacher":"sherry"},';
        $result .= '{"id":6,"title":"Ajax","contentcount":"31","photo":"http://m.tiebaimg.com/timg?wapp&quality=80&size=b150_150&subsize=20480&cut_x=0&cut_w=0&cut_y=0&cut_h=0&sec=1369815402&srctrace&di=3023252be28e87eddcba81adacfcb37e&wh_rate=null&src=http%3A%2F%2Fimgsrc.baidu.com%2Fforum%2Fpic%2Fitem%2F34fae6cd7b899e515938814643a7d933c8950d29.jpg","teacher":"李长宸"},';
        $result .= '{"id":7,"title":"HTML5","contentcount":"31","photo":"http://www.jywbphp.com/uploads/141115/1-141115150ZR49.jpg","teacher":"杜明坦"}';
      }elseif($id == 7){
        $result .= '{"id":1,"title":"HTML/CSS","contentcount":"31","photo":"http://www.html5cn.org/data/attachment/portal/201603/08/161339h9xbdqx2ggzqmuqy.jpg","teacher":"房森"},';
        $result .= '{"id":2,"title":"Javascript","contentcount":"45","photo":"http://m.tiebaimg.com/timg?wapp&quality=80&size=b150_150&subsize=20480&cut_x=0&cut_w=0&cut_y=0&cut_h=0&sec=1369815402&srctrace&di=ee77b5eebfb22fefafaf2c4e0b8fa9f8&wh_rate=null&src=http%3A%2F%2Fimgsrc.baidu.com%2Fforum%2Fpic%2Fitem%2Fb58f8c5494eef01f70276779e1fe9925bc317d5e.jpg","teacher":"吴兆辉"}';
      }
      else{
        $result .= '{"id":6,"title":"Ajax","contentcount":"31","photo":"http://m.tiebaimg.com/timg?wapp&quality=80&size=b150_150&subsize=20480&cut_x=0&cut_w=0&cut_y=0&cut_h=0&sec=1369815402&srctrace&di=3023252be28e87eddcba81adacfcb37e&wh_rate=null&src=http%3A%2F%2Fimgsrc.baidu.com%2Fforum%2Fpic%2Fitem%2F34fae6cd7b899e515938814643a7d933c8950d29.jpg","teacher":"李长宸"},';
        $result .= '{"id":7,"title":"HTML5","contentcount":"31","photo":"http://www.jywbphp.com/uploads/141115/1-141115150ZR49.jpg","teacher":"杜明坦"}';
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
