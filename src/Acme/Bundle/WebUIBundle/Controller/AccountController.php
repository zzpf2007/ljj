<?php

namespace Acme\Bundle\WebUIBundle\Controller;

use AppBundle\Entity\Account;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Utility\WebUtility\WebJson;
use AppBundle\Utility\WebApi\WebResponse\CategoryChildResponse;
use AppBundle\Utility\WebApi\WebResponse\CategoryRootResponse;

class AccountController extends Controller
{

   /**
    * @Template()
    */
    public function indexAction(Request $request)
    {      
        $em = $this->getDoctrine()->getManager();
        $accounts = $em->getRepository('AppBundle:Account')->findAll();

        $delete_form = $this->createFormBuilder()
                      ->setMethod('DELETE')
                      ->getForm();
       
        //$qb = $em->getRepository('AppBundle:User')->createQueryBuilder('n')->orderby('n.id','asc');
        //$paginator = $this->get('knp_paginator');
        //$pagination = $paginator->paginate($qb, $request->query->getInt('page', 1),5);

        return array('accounts' => $accounts,'delete_form' => $delete_form->createView());
    }
      /**
     * @Template()
     */
    public function deleteAction(Request $request,$id)
    {
         
        $em = $this->getDoctrine()->getManager();
        $account = $em->getRepository('AppBundle:Account')->find($id);

        $form = $this->createDeleteForm($account);

        $form->handleRequest($request);

        $em->remove($account);
        $em->flush();


        return $this->redirectToRoute('account_index_path');
    }

    private function createDeleteForm($account)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('account_delete_path', array('id' => $account->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
  
}

