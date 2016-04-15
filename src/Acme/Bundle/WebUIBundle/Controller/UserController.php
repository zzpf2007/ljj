<?php

namespace Acme\Bundle\WebUIBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Utility\WebUtility\WebJson;
use AppBundle\Utility\WebApi\WebResponse\CategoryChildResponse;
use AppBundle\Utility\WebApi\WebResponse\CategoryRootResponse;
use AppBundle\Utility\WebApi\User\ChangePwd;


class UserController extends Controller
{
  
    /**
     * @Template()
     */
    public function inAction(Request $request)
    {
       
    }
   
    /**
     * @Template()
     */
    public function authAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        $edit_form = $this->createFormBuilder($user)
                ->add('roles', null)       
                ->getForm();

        $edit_form->handleRequest($request);

        if ($edit_form->isSubmitted() && $edit_form->isValid()) {
  
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user_text_path');
        }

        return array(            
            'edit_form' => $edit_form->createView()
        );     
    }

    /**
     * @Template()
     */
    public function textAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return array('users' => $users); 
    }  

    /**
     * @Template()
     */
    public function adminAction(Request $request)
    {
         
    }

    /**
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();
 
       // $qb = $em->getRepository('AppBundle:User')->createQueryBuilder('n')->orderby('n.id','asc');
       // $paginator = $this->get('knp_paginator');
       // $pagination = $paginator->paginate($qb, $request->query->getInt('page', 1),5);


        $delete_form = $this->createFormBuilder()
                      ->setMethod('DELETE')
                      ->getForm();
          
        return array('users' => $users,'delete_form' => $delete_form->createView()); 
    }

    /**
     * @Template()
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        $edit_form = $this->createFormBuilder($user)
                ->add('username', null)
                ->add('mobile', null)
                ->add('email', null)         
                ->getForm();

        $edit_form->handleRequest($request);

        if ($edit_form->isSubmitted() && $edit_form->isValid()) {
  
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user_index_path');
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
        $user = new User();
        $new_form = $this->createFormBuilder($user)
                    ->add('username', null)
                    ->add('password', "password")
                    ->add('mobile', null)
                    ->add('email', null)
                    ->getForm();

        $new_form->handleRequest($request);

        if ($new_form->isSubmitted() && $new_form->isValid()) {
            
            $data = $new_form->getData();

            $user = new User();
            $user->setUsername($data->getUsername());
            $user->setEmail($data->getEmail());
            $user->setMobile($data->getMobile());
            $user->setPassword($this->encodePassword($user, $data->getPassword()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index_path');
        }
        return array(
            'new_form' => $new_form->createView()
        );  
    }
      private function encodePassword(User $user, $plainPassword)
    {
    $encoder = $this->container->get('security.encoder_factory')
        ->getEncoder($user)
    ;
    return $encoder->encodePassword($plainPassword, $user->getSalt());
    }

     /**
     * @Template()
     */
    public function deleteAction(Request $request,$id)
    {
         
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        $form = $this->createDeleteForm($user);

        $form->handleRequest($request);

        $em->remove($user);
        $em->flush();


        return $this->redirectToRoute('user_index_path');
    }

    private function createDeleteForm($user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete_path', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Template()
     */
    public function resetAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);

        $edit_form = $this->createFormBuilder($user)
                ->add('password', null)       
                ->getForm();

        $edit_form->handleRequest($request);

        if ($edit_form->isSubmitted() && $edit_form->isValid()) {
            // ... perform some action, such as saving the task to the database
             $data = $edit_form->getData();

            if ( '' !== $data->getPassword() ) {
                 $user->setPassword($this->encodePassword($user, $data->getPassword()));
             }

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user_index_path');
        }

        return array(            
            'edit_form' => $edit_form->createView(),
        ); 
    }
}

