<?php

namespace Core\CoreBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
      			->add('name',TextType::class,array(
    'attr'=>array('placeholder'=>'Nom'),
    'label'=>'Nom'
    ))
        		->add('firstName',TextType::class,array(
    'attr'=>array('placeholder'=>'Prenom'),
    'label'=>'Prenom'
    ))
        		->add('email',EmailType::class,array(
    'attr'=>array('placeholder'=>'email@email.email'),
    'label'=>'Email'
    ))
        		->add('subject', ChoiceType::class, array(
    'choices' => array('In Stock' => true, 'Out of Stock' => false),
    'label'=>'Indiquez-nous la raison de votre contact'
    ))
        		->add('body',TextareaType::class,array('label'=>'Votre message:'))
        		->add('save', SubmitType::class, array('label' => 'Envoyez','attr'=>array('class'=>'btn-green')));

    }
     /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\CoreBundle\Entity\Contact',
        ));
    }
	public function getName()
	  {
	    return 'core_corebundle_Contact';
	  }
}
