<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of searchType
 *
 * @author Ahmed MUSTAPHA
 */
namespace EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
       $builder->add('search', 'text',['attr' => ['placeholder' => 'Rechercher un produit'], 'label' => false ]);
      
    }
    
    public function getName() 
    {
        return 'products_search_form';   
    }

}
