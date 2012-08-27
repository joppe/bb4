<?php

namespace Aap\BluebirdsBundle\Form\Type;

use Aap\BluebirdsBundle\Form\Type\ClubType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\ORM\EntityRepository;

class TeamType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name')
            ->add('club', 'entity', array(
                'class' => 'AapBluebirdsBundle:Club',
                'query_builder' => function(EntityRepository $er) {
                    return $er
                        ->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC')
                    ;
                },
                'property' => 'name',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Aap\BluebirdsBundle\Entity\Team'
        ));
    }

    public function getName() {
        return 'team';
    }
}
