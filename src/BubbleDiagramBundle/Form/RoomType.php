<?php

namespace BubbleDiagramBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use BubbleDiagramBundle\Repository\LevelRepository;
use BubbleDiagramBundle\Repository\ZoneRepository;

class RoomType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $building_id = $options['building_id'];
        
        $builder->add('number')
                ->add('name')
                ->add('area')
                ->add('minHeight')
                ->add('requirements')
                ->add('description')
                ->add('maxPersonAmount')
                ->add('accessControl')
                ->add('level', EntityType::class, array(
                    'class' => 'BubbleDiagramBundle:Level',
                    'query_builder' => function (LevelRepository $er) use ($building_id) {
                    return $er->createQueryBuilder('level')
                            ->select('u')
                            ->from('BubbleDiagramBundle:Level', 'u')
                            ->where('u.building = :building_id')
                            ->setParameter('building_id', $building_id);
                    }
                ))
                ->add('zone', EntityType::class, array(
                    'class' => 'BubbleDiagramBundle:Zone',
                    'query_builder' => function (ZoneRepository $er) use ($building_id) {
                    return $er->createQueryBuilder('zone')
                            ->select('u')
                            ->from('BubbleDiagramBundle:Zone', 'u')
                            ->where('u.building = :building_id')
                            ->setParameter('building_id', $building_id);
                    }
                ))
                ->add('myRooms');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BubbleDiagramBundle\Entity\Room',
            'building_id' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bubblediagrambundle_room';
    }

}