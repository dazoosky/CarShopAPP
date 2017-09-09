<?php

namespace WorkshopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class VehicleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type')
            ->add('make')
            ->add('model')
            ->add('year')
            ->add('engineCapacity')
            ->add('fuel',null, array('required' => true))
            ->add('engineCode',null, array('required' => false))
            ->add('body',null, array('required' => false))
            ->add('insuranceDate', DateTimeType::class, array('date_widget' => 'single_text'))
            ->add('survayDate', DateTimeType::class, array('date_widget' => 'single_text'))
            ->add('vin')
            ->add('plateNo')
            ->add('owner');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WorkshopBundle\Entity\Vehicle'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'workshopbundle_vehicle';
    }


}
