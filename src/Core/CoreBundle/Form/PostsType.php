<?php

namespace Core\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
class PostsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title',TextType::class,array('label'=>'Titre'))
        ->add('content',TextareaType::class,array('label'=>'Contenu'))
        ->add('images',CollectionType::class,array(
                    "entry_type"=>ImagesType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype'=>true,
                    'by_reference'=>true
                ))
         ->add('save',SubmitType::class,array('label' => 'Save'));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\CoreBundle\Entity\Posts'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'core_corebundle_posts';
    }


}
