<?php

namespace Aap\BluebirdsBundle\Form\Type;

use Aap\BluebirdsBundle\Entity\Club;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class MemberType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('first_name', 'text', array('required' => false))
            ->add('middle_name', 'text', array('required' => false))
            ->add('last_name', 'text', array('required' => false))
            ->add('email', 'text', array('required' => false))
            ->add('telephone', 'text', array('required' => false))
            ->add('mobile', 'text', array('required' => false))
            ->add('street', 'text', array('required' => false))
            ->add('zip', 'text', array('required' => false))
            ->add('city', 'text', array('required' => false))
            ->add('membership_number', 'text', array('required' => false))
            ->add('club', 'entity', array(
                'class' => 'AapBluebirdsBundle:Club',
                'query_builder' => function (EntityRepository $er) {
                    return $er
                        ->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC')
                    ;
                },
                'property' => 'name'
            ))
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
