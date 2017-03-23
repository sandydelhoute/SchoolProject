<?php

namespace Core\CoreBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OpeningType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
            ->add('timeopen', TimeType::class)
            ->add('timeclose', TimeType::class)
            ->add('timedelivry', TimeType::class)
            ->add('timelimitshop', TimeType::class)
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