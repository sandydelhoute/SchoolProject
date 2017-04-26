<?php

namespace Core\CoreBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CoordonatesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
          	->add('name',TextType::class)
      		->add('parents',EntityType::class, array(
                        'class'    => 'CoreCoreBundle:Categorie',
                        'choice_label' => 'name',
                        'expanded'=>false,
                        'multiple'=>false,
                        'empty_data'  => null,
                        'required'      => false,

                        ))
          ->add('save', SubmitType::class, array('label' => 'Save'));

    }
     /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\CoreBundle\Entity\Coordonates',
        ));
    }
	public function getName()
	  {
	    return 'core_corebundle_coordonates';
	  }
}