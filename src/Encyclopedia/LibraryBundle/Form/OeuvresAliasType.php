<?php

namespace Encyclopedia\LibraryBundle\Form;

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
            ->add('oeuvres','entity',array('class' => 'EncyclopediaLibraryBundle:Oeuvres',
                                            'property' => 'name',
                                            'label' => 'Oeuvre'))
            ->add('languages','entity',array('class' => 'EncyclopediaLibraryBundle:Lang',
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
            'data_class' => 'Encyclopedia\LibraryBundle\Entity\OeuvresAlias'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_LibraryBundle_oeuvresalias';
    }
}
