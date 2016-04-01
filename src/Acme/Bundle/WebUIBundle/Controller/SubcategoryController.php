<?php

namespace Acme\Bundle\WebUIBundle\Controller;

use AppBundle\Entity\Subcategory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Utility\WebUtility\WebJson;
use AppBundle\Utility\WebApi\WebResponse\CategoryChildResponse;
use AppBundle\Utility\WebApi\WebResponse\CategoryRootResponse;

class SubcategoryController extends Controller
{

   /**
    * @Template()
    */
    public function indexAction(Request $request)
    {      
        $em = $this->getDoctrine()->getManager();
        $subcategories = $em->getRepository('AppBundle:Subcategory')->findAll();

        $delete_form = $this->createFormBuilder()
                      ->setMethod('DELETE')
                      ->getForm();

        //$qb = $em->getRepository('AppBundle:User')->createQueryBuilder('n')->orderby('n.id','asc');
        //$paginator = $this->get('knp_paginator');
        //$pagination = $paginator->paginate($qb, $request->query->getInt('page', 1),5);

        return array('subcategories' => $subcategories,'delete_form' => $delete_form->createView());
    }
    
      /**
    * @Template()
    */
    public function editAction(Request $request, $id)
    {      
        $em = $this->getDoctrine()->getManager();
        $subcategory = $em->getRepository('AppBundle:Subcategory')->find($id);

        $edit_form = $this->createFormBuilder($subcategory)
                ->add('title', null)       
                ->getForm();

        $edit_form->handleRequest($request);

        if ($edit_form->isSubmitted() && $edit_form->isValid()) {
            $em->persist($subcategory);
            $em->flush();

            return $this->redirectToRoute('subcategory_index_path');
        }

        return array(            
            'edit_form' => $edit_form->createView()
        );
    }

    /**
     * @Template()
     */
    public function createAction(Request $request)
    {
       
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AppBundle:Category')->findAll();

        $attr=array('empty_value' => '请选择');    
        foreach($categories as $category)
        {
            $attr[$category->getId()] = $category->getTitle();
        }
              
        $subcategory = new Subcategory();
        // See http://symfony.com/doc/current/book/forms.html#submitting-forms-with-multiple-buttons
        $new_form = $this->createFormBuilder($subcategory)             
                    ->add('title', null)
                    ->add('category', 'choice', array('choices' => $attr))        
                    ->getForm();
        
        $category = null;
        if ($request->getMethod() == "POST") {  
            $formData = $request->request->get($new_form->getName());
            $category = $em->getRepository('AppBundle:Category')->findOneBy(array('id'=>$formData['category']));
            $formData['category'] = null;      
            $new_form->bind($formData); 
        } 
        if ($new_form->isSubmitted() && $new_form->isValid()) {
          
            $subcategory->setCategory($category);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subcategory);
            $entityManager->flush();
            return $this->redirectToRoute('subcategory_index_path');
        }
        return array(
            'new_form' => $new_form->createView()
        );
    }

     /**
     * @Template()
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $subcategory = $em->getRepository('AppBundle:Subcategory')->find($id);

        $form = $this->createDeleteForm($subcategory);
        $form->handleRequest($request);
      
        $em->remove($subcategory);
        $em->flush();

        return $this->redirectToRoute('subcategory_index_path');
    }
    private function createDeleteForm($subcategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subcategory_delete_path', array('id' => $subcategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
  
}

