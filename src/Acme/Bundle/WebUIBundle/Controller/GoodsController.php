<?php

namespace Acme\Bundle\WebUIBundle\Controller;

use AppBundle\Entity\Goods;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Utility\WebUtility\WebJson;
use AppBundle\Utility\WebApi\WebResponse\CategoryChildResponse;
use AppBundle\Utility\WebApi\WebResponse\CategoryRootResponse;

class GoodsController extends Controller
{

   /**
    * @Template()
    */
    public function indexAction(Request $request)
    {      
        $em = $this->getDoctrine()->getManager();
        $goods = $em->getRepository('AppBundle:Goods')->findAll();

        $delete_form = $this->createFormBuilder()
                      ->setMethod('DELETE')
                      ->getForm();

        return array('goods' => $goods,'delete_form' => $delete_form->createView());
    }

     /**
     * @Template()
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $good = $em->getRepository('AppBundle:Goods')->find($id);

        $form = $this->createDeleteForm($good);

        $form->handleRequest($request);

        $em->remove($good);
        $em->flush();

        return $this->redirectToRoute('goods_index_path');
    }

    private function createDeleteForm($good)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('goods_delete_path', array('id' => $good->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    
    /**
     * @Template()
     */
     public function newAction(Request $request)
     {
        $good = new Goods();
        // See http://symfony.com/doc/current/book/forms.html#submitting-forms-with-multiple-buttons
        $new_form = $this->createFormBuilder($good)
                    ->add('goodsname', null) 
                    ->add('goodsnumber', null) 
                    ->add('soldnumber',null)  
                    ->add('goodsprice',null)
                    ->add('goodsphoto',null)        
                    ->getForm();

        $new_form->handleRequest($request);

        if ($new_form->isSubmitted() && $new_form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($good);
            $entityManager->flush();

            return $this->redirectToRoute('goods_index_path');
        }

        return array(
            'new_form' => $new_form->createView()
        ); 
      }

}

