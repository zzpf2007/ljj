<?php

namespace Acme\Bundle\WebUIBundle\Controller;

use AppBundle\Entity\Coupons;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Utility\WebUtility\WebJson;
use AppBundle\Utility\WebApi\WebResponse\CategoryChildResponse;
use AppBundle\Utility\WebApi\WebResponse\CategoryRootResponse;

class CouponsController extends Controller
{

    /**
    * @Template()
    */
    public function allAction(Request $request)
    {      
        $em = $this->getDoctrine()->getManager();
        $coupons = $em->getRepository('AppBundle:Coupons')->findAll();

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return array('coupons' => $coupons,'users' => $users);
    }



   /**
    * @Template()
    */
    public function indexAction(Request $request)
    {      
        $em = $this->getDoctrine()->getManager();
        $coupons = $em->getRepository('AppBundle:Coupons')->findAll();

        $delete_form = $this->createFormBuilder()
                      ->setMethod('DELETE')
                      ->getForm();

        return array('coupons' => $coupons,'delete_form' => $delete_form->createView());
    }

     /**
     * @Template()
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $coupon = $em->getRepository('AppBundle:Coupons')->find($id);

        $form = $this->createDeleteForm($coupon);

        $form->handleRequest($request);

        $em->remove($coupon);
        $em->flush();

        return $this->redirectToRoute('coupons_index_path');
    }

    private function createDeleteForm($coupon)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('coupons_delete_path', array('id' => $coupon->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Template()
     */
     public function newAction(Request $request)
     {
        $coupon = new Coupons();
        // See http://symfony.com/doc/current/book/forms.html#submitting-forms-with-multiple-buttons
        $new_form = $this->createFormBuilder($coupon)
                    ->add('amount', null) 
                    ->add('species', null) 
                    ->add('minmoney',null)  
                    ->add('time',null)      
                    ->getForm();

        $new_form->handleRequest($request);

        if ($new_form->isSubmitted() && $new_form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coupon);
            $entityManager->flush();

            return $this->redirectToRoute('coupons_index_path');
        }

        return array(
            'new_form' => $new_form->createView()
        ); 
      }

}

