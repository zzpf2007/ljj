<?php

namespace Acme\Bundle\WebUIBundle\Controller;

use AppBundle\Entity\Item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Utility\WebUtility\WebJson;
use AppBundle\Utility\WebApi\WebResponse\CategoryChildResponse;
use AppBundle\Utility\WebApi\WebResponse\CategoryRootResponse;

class VideoController extends Controller
{

   /**
    * @Template()
    */
    public function indexAction(Request $request,$id)
    {      
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Item')->find($id);

       // var_dump($items);die;

        return array('items' => $items);
    }
    
}

