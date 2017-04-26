<?php

namespace Core\CoreBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\Common\Collections\ArrayCollection;

class OpeningType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('relais',EntityType::class,array(
          'class' => 'CoreCoreBundle:Relais',          
              'multiple' => false,
              'expanded' => false,
              'label'=>"selectionner le relais"
              ))
    ->add('dayopen',ChoiceType::class,array(
    'choices'  => array(
        'Lundi' => 'Monday',
        'Mardi' =>'Tuesday',
        'Mercredi' => 'Wednesday',
        'Jeudi' => 'Thursday',
        'Vendredi' => 'Friday',
        'Samedi' =>'Saturday' ,
        'Dimanche' => 'Sunday'
      ),'label'=>"Selectionner le jour "))
    ->add('timeopen', TimeType::class,array('placeholder' => array(
      'hour' => 'Heure', 'minute' => 'Minute',
      ),'with_seconds'=>false,'label'=>"heure d'ouverture"))
    ->add('timeclose', TimeType::class,array('placeholder' => array(
      'hour' => 'Hour', 'minute' => 'Minute',
      ),'with_seconds'=>false,'label'=>"heure de fermeture"))
    ->add('timedelivry', TimeType::class,array('placeholder' => array(
      'hour' => 'Heure', 'minute' => 'Minute',
      ),'with_seconds'=>false,'label'=>"heure de livraison"))
    ->add('timelimitshop', TimeType::class,array('placeholder' => array(
      'hour' => 'Heure', 'minute' => 'Minute',
      ),'with_seconds'=>false,'label'=>"heure limite des commandes"))
    ->add('save', SubmitType::class, array('label' => 'Save'));
  }
  /**
   * @param OptionsResolver $resolver
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Core\CoreBundle\Entity\Opening',
      ));
  }
  public function getName()
  {
    return 'core_corebundle_opening';
  }
}