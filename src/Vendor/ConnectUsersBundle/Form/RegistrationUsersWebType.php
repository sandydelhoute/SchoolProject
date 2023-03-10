<?php
namespace Vendor\ConnectUsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SelectType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Vendor\ConnectUsersBundle\Entity\BusinessCompany;
use Symfony\Component\OptionsResolver\OptionsResolver;
class RegistrationUsersWebType extends AbstractType
{

public function buildForm(FormBuilderInterface $builder, array $options)
{
  			$builder
            ->add('email', EmailType::class,array('attr'=>array('placeholder'=>'email@email.email')))
            ->add('name', TextType::class,array('label'=>"Prénom",'attr'=>array('placeholder'=>'Prenom')))
            ->add('firstname', TextType::class,array('label'=>"Nom",'attr'=>array('placeholder'=>'Nom')))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Mot de passe','attr'=>array('placeholder'=>'Mot de passe')),
                'second_options' => array('label' => 'Confirmation du mot de passe','attr'=>array('placeholder'=>'Mot de passe')),
            ))
            ->add('termsAccepted', CheckboxType::class, array(
                'mapped' => false
            ))
            ->add('save', SubmitType::class, array('label' => 'M\'inscire','attr' => array('class' => 'btn-green'),));
}
/**
 * @param OptionsResolver $resolver
 */
public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults(array(
            'data_class' => 'Vendor\ConnectUSersBundle\Entity\UsersWeb',
    ));
}
public function getName()
  {
    return 'vendor_registerusersbundle_usersweb';
  }
}