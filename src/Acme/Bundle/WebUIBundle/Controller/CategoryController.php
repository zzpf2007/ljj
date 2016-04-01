<?php

namespace Acme\Bundle\WebUIBundle\Controller;

use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Utility\WebUtility\WebJson;
use AppBundle\Utility\WebApi\WebResponse\CategoryChildResponse;
use AppBundle\Utility\WebApi\WebResponse\CategoryRootResponse;

class CategoryController extends Controller
{

   /**
    * @Template()
    */
    public function indexAction(Request $request)
    {      
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AppBundle:Category')->findAll();

        $delete_form = $this->createFormBuilder()
                      ->setMethod('DELETE')
                      ->getForm();

        //$qb = $em->getRepository('AppBundle:User')->createQueryBuilder('n')->orderby('n.id','asc');
        //$paginator = $this->get('knp_paginator');
        //$pagination = $paginator->paginate($qb, $request->query->getInt('page', 1),5);

        return array('categories' => $categories,'delete_form' => $delete_form->createView());
    }
    
    /**
    * @Template()
    */
    public function createAction(Request $request)
    {      
        $category = new Category();

        $new_form = $this->createFormBuilder($category)
                    ->add('title', null)        
                    ->getForm();

        $new_form->handleRequest($request);

        if ($new_form->isSubmitted() && $new_form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category_index_path');
        }

        return array(
            'new_form' => $new_form->createView()
        ); 
    }

    /**
    * @Template()
    */
    public function editAction(Request $request, $id)
    {      
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Category')->find($id);

        $edit_form = $this->createFormBuilder($category)
                ->add('title', null)       
                ->getForm();

        $edit_form->handleRequest($request);

        if ($edit_form->isSubmitted() && $edit_form->isValid()) {
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('category_index_path');
        }

        return array(            
            'edit_form' => $edit_form->createView()
        );
    }

     /**
     * @Template()
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('AppBundle:Category')->find($id);

        $form = $this->createDeleteForm($category);
        $form->handleRequest($request);
      
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('category_index_path');
    }
    private function createDeleteForm($category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('category_delete_path', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
  
}

