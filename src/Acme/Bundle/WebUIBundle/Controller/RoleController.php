<?php

namespace Acme\Bundle\WebUIBundle\Controller;

use AppBundle\Entity\Role;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Utility\WebUtility\WebJson;
use AppBundle\Utility\WebApi\WebResponse\CategoryChildResponse;
use AppBundle\Utility\WebApi\WebResponse\CategoryRootResponse;

class RoleController extends Controller
{

   /**
    * @Template()
    */
    public function indexAction(Request $request)
    {      
        $em = $this->getDoctrine()->getManager();
        $roles = $em->getRepository('AppBundle:Role')->findAll();

        $delete_form = $this->createFormBuilder()
                      ->setMethod('DELETE')
                      ->getForm();

        return array('roles' => $roles,'delete_form' => $delete_form->createView());
    }

   /**
    * @Template()
    */
    public function editAction(Request $request, $id)
    {      
        $em = $this->getDoctrine()->getManager();
        $role = $em->getRepository('AppBundle:Role')->find($id);

        $edit_form = $this->createFormBuilder($role)
                ->add('name', null)       
                ->getForm();

        $edit_form->handleRequest($request);

        if ($edit_form->isSubmitted() && $edit_form->isValid()) {
            $em->persist($role);
            $em->flush();

            return $this->redirectToRoute('role_index_path');
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
        $role = new Role();

        $new_form = $this->createFormBuilder($role)
                    ->add('name', null)        
                    ->getForm();

        $new_form->handleRequest($request);

        if ($new_form->isSubmitted() && $new_form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($role);
            $entityManager->flush();

            return $this->redirectToRoute('role_index_path');
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
        $role = $em->getRepository('AppBundle:Role')->find($id);

        $form = $this->createDeleteForm($role);
        $form->handleRequest($request);
      
        $em->remove($role);
        $em->flush();

        return $this->redirectToRoute('role_index_path');
    }
    private function createDeleteForm($role)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('role_delete_path', array('id' => $role->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
  
}

