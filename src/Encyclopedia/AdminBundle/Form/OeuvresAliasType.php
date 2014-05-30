<?php

namespace Encyclopedia\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OeuvresAliasType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('oeuvres','entity',array('class' => 'EncyclopediaAdminBundle:Oeuvres',
                                            'property' => 'name',
                                            'label' => 'Oeuvre'))
            ->add('languages','entity',array('class' => 'EncyclopediaAdminBundle:Lang',
                                             'property' => 'name',
                                             'label' => 'Language'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Encyclopedia\AdminBundle\Entity\OeuvresAlias'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_adminbundle_oeuvresalias';
    }
}
