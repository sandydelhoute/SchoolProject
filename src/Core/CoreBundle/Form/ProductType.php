<?php

namespace Core\CoreBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Core\CoreBundle\Form\ImagesType;
use Core\CoreBundle\Form\AllergeneType;
use Core\CoreBundle\Form\CategorieType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
            ->add('name', TextType::class,array(
                  'label'=>"Entrer le nom du produits"
            ))
            ->add('description', TextareaType::class)
            ->add('composition', TextareaType::class)
            ->add('prix', NumberType::class)
            ->add('active', ChoiceType::class,array('choices'  => array(
        		'Oui' => true,
        		'Non' => false
   		         ),'label'=>"le produit est-il déjâ en ventes?"))

          ->add('providers',EntityType::class,array(
              'class' => 'CoreCoreBundle:Provider',          
              'label'=>"selectionner le fourniseur du produit"
              ))

            ->add('images',CollectionType::class,array(
            	"entry_type"=>ImagesType::class,
      				'allow_add' => true,
      				'allow_delete' => true,
      				'prototype'=>true,
              'by_reference'=>true
            	))
              
            ->add('categories', EntityType::class, array(
              'class' => 'CoreCoreBundle:Categorie',          
              'multiple' => true,
              'expanded' => true,
              'label'=>"Selectionner la ou les categories"
              ))
            ->add('allergenes', EntityType::class, array(
              'class' => 'CoreCoreBundle:Allergene',          
              'multiple' => true,
              'expanded' => true,
              'label'=>"Selectionner les allergenes"
              ))
           
            
            ->add('save', SubmitType::class, array('label' => 'Save'));

    

}
     /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\CoreBundle\Entity\Product',
        ));
    }
public function getName()
  {
    return 'core_corebundle_product';
  }
}