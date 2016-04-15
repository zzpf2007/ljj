<?php

namespace Acme\Bundle\WebUIBundle\Controller;

use AppBundle\Entity\Group;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Utility\WebUtility\WebJson;
use AppBundle\Utility\WebApi\WebResponse\CategoryChildResponse;
use AppBundle\Utility\WebApi\WebResponse\CategoryRootResponse;

class GroupController extends Controller
{

   /**
    * @Template()
    */
    public function indexAction(Request $request)
    {      
        $em = $this->getDoctrine()->getManager();
        $groups = $em->getRepository('AppBundle:Group')->findAll();
        return array('groups' => $groups);
    }

    /**
    * @Template()
    */
    public function editAction(Request $request, $id)
    {      
        $em = $this->getDoctrine()->getManager();
        $group = $em->getRepository('AppBundle:Group')->find($id);

        $edit_form = $this->createFormBuilder($group)
                ->add('name', null)       
                ->getForm();

        $edit_form->handleRequest($request);

        if ($edit_form->isSubmitted() && $edit_form->isValid()) {
            $em->persist($group);
            $em->flush();

            return $this->redirectToRoute('group_index_path');
        }

        return array(            
            'edit_form' => $edit_form->createView()
        );
    }
  
}

