<?php

namespace Acme\Bundle\WebUIBundle\Controller;

use AppBundle\Entity\Message;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Utility\WebUtility\WebJson;
use AppBundle\Utility\WebApi\WebResponse\CategoryChildResponse;
use AppBundle\Utility\WebApi\WebResponse\CategoryRootResponse;

class MessageController extends Controller
{

   /**
    * @Template()
    */
    public function indexAction(Request $request)
    {      
        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository('AppBundle:Message')->findAll();
        return array('messages' => $messages);
    }

    /**
    * @Template()
    */
    public function allAction(Request $request)
    {      
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:user')->findAll();
        return array('users' => $users);
    }

}

