<?php

namespace EcommerceBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use /** @noinspection PhpUnusedAliasInspection */
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use EcommerceBundle\Form\SearchType;

class ProduitController extends Controller
{
    /**
     * @Route("/products", name="product_list")
     * 
     * @return array|response  
     */
    public function listAction()
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $data = $em->getRepository('EcommerceBundle:Produits')->findAll();
            $products = $this->get('knp_paginator')->paginate( $data,$this->get('request')->query->get('page', 1), 6 );
            
            return $this->render('Produit/index.html.twig', [ 'products' => $products ]);
            
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }
    /**
     * @Route("/products/{productId}", name="product_display")
     * 
     * @return array|response  
     */
    public function displayAction( $productId )
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('EcommerceBundle:Produits')->find($productId);
        return $this->render('Produit/display.html.twig', [ 'product' => $product ]);
    }
    /**
     * @Route("/product/new", name="product_create")
     */
    public function createAction()
    {
        // to do
    }
    
    /**
     * display form of search
     * @Route("/product/searchForm", name="product_search_form")
     * @return form
     */
    public function formSearchAction()
    {
        $form = $this->createForm( new SearchType() );
        return $this->render('Search/index.html.twig', [ 'form' => $form->createView() ]);
    }
    
    /**
     * Search a products
     * @Route("/product/search", name="product_search")
     * @Method({"GET", "POST"})
     * @return array list of products
     */
    public function searchAction(Request $request)
    {
        $form = $this->createForm(new SearchType())->handleRequest($request);
        try{
            if ($form->isValid()) {
                $data = $form->getData() ;
                $em = $this->getDoctrine()->getManager();
                $products = $em->getRepository('EcommerceBundle:Produits')->search($data['search']);    
                return $this->render('Search/search.html.twig', [ 'products' => $products ]);
                
            }
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }
}
