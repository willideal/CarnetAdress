<?php
namespace CarnetadressBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarnetAdressForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)

  {

    $builder

      ->add('nom',      'text')

      ->add('email',     'text')

      ->add('adresse',    'text')

      ->add('telephone',   'text')

      ->add('siteweb',   'text')

    ;

  }


  public function setDefaultOptions(OptionsResolverInterface $resolver)

  {

    $resolver->setDefaults(array(

      'data_class' => 'CarnetadressBundle\Entity\CarnetAdress'

    ));

  }


  public function getName()

  {

    return 'carnet_adress_lister';

  }
}