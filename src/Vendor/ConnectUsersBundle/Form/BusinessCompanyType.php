<?php

namespace Vendor\ConnectUsersBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BusinessCompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
  			$builder
           ->remove('name',TextType::class);
           
           }
     /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vendor\ConnectUSersBundle\Entity\BusinessCompany',
        ));
    }
public function getName()
  {
    return 'vendor_connectusersbundle_businessCompany';
  }
}