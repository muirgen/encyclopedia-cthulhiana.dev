<?php

namespace Encyclopedia\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CataloguesAliasType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('languages','entity', array('class' => 'EncyclopediaLibraryBundle:Lang',
                                            'property' => 'name',
                                            'label' => 'Language'))
            ->add('description','textarea', array('required' => false))
            ->add('note', 'textarea', array('required' => false))
            ->add('catalogues','entity', array('class' => 'EncyclopediaLibraryBundle:Catalogues',
                                                        'property' => 'name',
                                                        'label' => 'Catalogue parent')        
        );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Encyclopedia\LibraryBundle\Entity\CataloguesAlias'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_LibraryBundle_cataloguesalias';
    }
}
