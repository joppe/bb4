<?php

namespace Aap\BluebirdsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TeamType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name');
    }

    public function getName() {
        return 'team';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Aap\BluebirdsBundle\Entity\Team'
        );
    }
}