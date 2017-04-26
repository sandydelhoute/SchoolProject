<?php

namespace Core\CoreBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Core\CoreBundle\Form\ImagesType;
use Core\CoreBundle\Form\AllergeneType;
use Core\CoreBundle\Form\CategorieType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('composition', TextType::class)
            ->add('prix', MoneyType::class)
            ->add('active', ChoiceType::class,array('choices'  => array(
        		'Yes' => true,
        		'No' => false
   		)))
            ->add('images',CollectionType::class,array(
            	"entry_type"=>ImagesType::class,
      				'allow_add' => true,
      				'allow_delete' => false,
      				'prototype'=>true
            	))
        
            ->add('categories', EntityType::class, array(
              'class' => 'CoreCoreBundle:Categorie',          
              'multiple' => true,
              'expanded' => true

              ))
           ->add('products', EntityType::class, array(
              'class' => 'CoreCoreBundle:Product',          
              'multiple' => true,
              'expanded' => true
              ))
          ->add('save', SubmitType::class, array('label' => 'Save'));
    }
     /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\CoreBundle\Entity\Menu',
        ));
    }
public function getName()
  {
    return 'core_corebundle_menu';
  }
}