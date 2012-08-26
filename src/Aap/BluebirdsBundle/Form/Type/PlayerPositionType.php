<?php

namespace Aap\BluebirdsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlayerPositionType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('rating')
            ->add('player')
            ->add('position')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Aap\BluebirdsBundle\Entity\PlayerPosition'
        ));
    }

    public function getName() {
        return 'playerposition';
    }
}
