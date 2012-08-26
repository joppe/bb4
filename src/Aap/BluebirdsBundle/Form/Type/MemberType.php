<?php

namespace Aap\BluebirdsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MemberType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('first_name')
            ->add('middle_name')
            ->add('last_name')
            ->add('email')
            ->add('telephone')
            ->add('mobile')
            ->add('street')
            ->add('zip')
            ->add('city')
            ->add('membership_number')
            ->add('club')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Aap\BluebirdsBundle\Entity\Member'
        ));
    }

    public function getName() {
        return 'member';
    }
}
