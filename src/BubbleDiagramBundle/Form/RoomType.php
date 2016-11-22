<?php

namespace BubbleDiagramBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('number')->add('name')->add('area')->add('minHeight')->add('requirements')->add('description')->add('maxPersonAmount')->add('accessControl')->add('level')->add('zone')->add('roomsWithMe')->add('myRooms')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BubbleDiagramBundle\Entity\Room'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bubblediagrambundle_room';
    }


}
