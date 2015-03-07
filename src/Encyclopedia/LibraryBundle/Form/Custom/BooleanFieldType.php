<?php
//http://symfony.com/fr/doc/current/cookbook/form/create_custom_field_type.html
namespace Encyclopedia\LibraryBundle\Form\Custom;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BooleanFieldType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                false => 'No',
                true => 'Yes',
            ),
            'expanded' => true,
            'required'  => true
        ));
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'booleanField';
    }
}