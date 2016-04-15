<?php

namespace Acme\Bundle\MobileBundle\Services;

use Acme\Bundle\MobileBundle\Services\ApiMobileMode;
use AppBundle\Utility\WebUtility\WebJson;
use AppBundle\Utility\WebUtility\WebAuto;

class ApiMobileCategory extends ApiMobileMode
{
  public function getResponse()
  {
    $content = $this->getHomeContent();
    // $content = WebJson::strRemoveSpace($content);
    return $content;
  }

  private function getHomeContent()
  {
    $result = '{"code":0,"message":"succeed!",';
    $result .= '"result":{';
    $result .= '"list":[';
    $result .= '{"id":1,"title":"HTML/CSS","icon":"null","category_id":"1", "click_url":"app.ljj.cn/api/school/categories/1"},';
    $result .= '{"id":2,"title":"Javascript","icon":"null","category_id":"2","click_url":"app.ljj.cn/api/school/categories/2"},';
    $result .= '{"id":3,"title":"jQuery","icon":"null","category_id":"3","click_url":"app.ljj.cn/api/school/categories/3"},';
    $result .= '{"id":4,"title":"bootstrap","icon":"null","category_id":"4","click_url":"app.ljj.cn/api/school/categories/4"},';
    $result .= '{"id":5,"title":"node.JS","icon":"null","category_id":"5","click_url":"app.ljj.cn/api/school/categories/5"},';
    $result .= '{"id":6,"title":"Ajax","icon":"null","category_id":"6","click_url":"app.ljj.cn/api/school/categories/6"},';
    $result .= '{"id":7,"title":"HTML5","icon":"null","category_id":"7","click_url":"app.ljj.cn/api/school/categories/7"},';
    $result .= '{"id":8,"title":"更多..","icon":"null","category_id":"null","click_url":"null"}';
    $result .= ']}}';

    return $result;
  }

  protected function getUrl()
  {
    return '';
  }

}