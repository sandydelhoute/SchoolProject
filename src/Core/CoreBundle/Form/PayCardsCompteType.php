<?php

namespace Core\CoreBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PayCardsCompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
      			->add('name',TextType::class,array(
    'attr'=>array('placeholder'=>'Nom du titulaire de la carte'),
    'label'=>'Nom'
    ))
        		->add('numberCards',NumberType::class,array(
    'attr'=>array('placeholder'=>'1111222233334444'),
    'label'=>'Numero de carte'
    ))
        		->add('dateExpiration',DateType::class,array(
    'attr'=>array('placeholder' => 'Select a value'),
    'label'=>'date d\'expiration',
        'years' => range(date('Y'), date('Y')+5),
        'widget' => 'choice',
        'format' => 'd/MM/yyyy hh:mm',
        ))
        		->add('solde',NumberType::class,array(
     'attr'=>array('placeholder'=>'0'),
    'label'=>'solde'
        			))
    ->add('securityCode',NumberType::class,array('label'=>'Code de sécurité'))
    ->add('save', SubmitType::class, array('label' => 'Envoyez','attr'=>array('class'=>'btn-green')));

    }
     /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Core\CoreBundle\Entity\PayCardsCompte',
        ));
    }
	public function getName()
	  {
	    return 'core_corebundle_paycardscompte';
	  }
}
