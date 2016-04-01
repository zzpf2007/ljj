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

class ItemController extends Controller
{

   /**
    * @Template()
    */
    public function indexAction(Request $request)
    {      
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Item')->findAll();

        $delete_form = $this->createFormBuilder()
                      ->setMethod('DELETE')
                      ->getForm();

        //$qb = $em->getRepository('AppBundle:User')->createQueryBuilder('n')->orderby('n.id','asc');
        //$paginator = $this->get('knp_paginator');
        //$pagination = $paginator->paginate($qb, $request->query->getInt('page', 1),5);

        return array('items' => $items,'delete_form' => $delete_form->createView());
    }
    
     /**
    * @Template()
    */
    public function editAction(Request $request, $id)
    {      
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('AppBundle:Item')->find($id);

        $edit_form = $this->createFormBuilder($item)
                ->add('title', null) 
                ->add('photo', null) 
                ->add('duration', null) 
                ->add('tcvideourl', null)       
                ->getForm();

        $edit_form->handleRequest($request);

        if ($edit_form->isSubmitted() && $edit_form->isValid()) {
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('item_index_path');
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
        $courses = $em->getRepository('AppBundle:Course')->findAll();

        $attr=array('empty_value' => '请选择');    
        foreach($courses as $course)
        {
            $attr[$course->getId()] = $course->getTitle();
        }
              
        $item = new Item();
        // See http://symfony.com/doc/current/book/forms.html#submitting-forms-with-multiple-buttons
        $new_form = $this->createFormBuilder( $item)             
                     ->add('title', null) 
                    ->add('photo', null) 
                    ->add('duration', null) 
                    ->add('tcvideourl', null)   
                    ->add('course', 'choice', array('choices' => $attr))        
                    ->getForm();
        
        $course = null;
        if ($request->getMethod() == "POST") {  
            $formData = $request->request->get($new_form->getName());
            $course = $em->getRepository('AppBundle:Course')->findOneBy(array('id'=>$formData['course']));
            $formData['course'] = null;      
            $new_form->bind($formData); 
        } 
        if ($new_form->isSubmitted() && $new_form->isValid()) {
          
            $item->setCourse($course);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($item);
            $entityManager->flush();
            return $this->redirectToRoute('item_index_path');
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
        $item = $em->getRepository('AppBundle:Item')->find($id);

        $form = $this->createDeleteForm($item);
        $form->handleRequest($request);
      
        $em->remove($item);
        $em->flush();

        return $this->redirectToRoute('item_index_path');
    }
    private function createDeleteForm($item)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('item_delete_path', array('id' => $item->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

  
}

