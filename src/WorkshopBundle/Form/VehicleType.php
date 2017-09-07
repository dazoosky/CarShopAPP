<?php

namespace WorkshopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type')->add('make')->add('model')->add('year')->add('engineCapacity')->add('fuel')->add('engineCode')->add('body')->add('insuranceDate')->add('survayDate')->add('vin')->add('plateNo')->add('owner');
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
