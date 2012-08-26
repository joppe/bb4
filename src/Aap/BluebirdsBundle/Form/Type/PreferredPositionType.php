<?php

namespace Aap\BluebirdsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PreferredPositionType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('rating')
            ->add('team_member')
            ->add('postition')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Aap\BluebirdsBundle\Entity\PreferredPosition'
        ));
    }

    public function getName() {
        return 'preferredposition';
    }
}
