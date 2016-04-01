<?php

namespace Acme\Bundle\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
  /**
  * @Route("/category")
  */
  public function indexAction(Request $request)
  {     
      $em = $this->getDoctrine()->getManager();
      $categories = $em->getRepository('AppBundle:Category')->findAll();

      $em = $this->getDoctrine()->getManager();
      $subcategories = $em->getRepository('AppBundle:Subcategory')->findAll();

      
      $top = array();
      foreach ($categories as $category) {
          $sub = array();
          $subcategories = $category->getSubcategory();
          foreach ($subcategories as $subcategory) {
             $sub[] = sprintf('{"id":"%s","title":"%s"}', $subcategory->getId(), $subcategory->getTitle());
          }
          
          $top[] = sprintf('{"id":"%s", "title":"%s", "children":[%s]}', $category->getId(), $category->getTitle(), implode(',', $sub));

      }
      $result = '{"result": ['. implode(',', $top) .']}';
      
      return new Response($result);
      }

  }


