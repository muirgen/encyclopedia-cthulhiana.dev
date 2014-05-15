<?php

namespace Encyclopedia\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonsAliasType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('id_person', 'entity', array('class' => 'EncyclopediaAdminBundle:Persons',
                                                'property' => 'name',
                                                'label' => 'Person name'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Encyclopedia\AdminBundle\Entity\PersonsAlias'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_adminbundle_personsalias';
    }
}
