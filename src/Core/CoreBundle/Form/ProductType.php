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
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
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
        		->add('categorie',CollectionType::class,array(
              "entry_type"=>CategorieType::class,
        'allow_add' => true,
        'allow_delete' => false,
        'prototype'=>true
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