<?php

namespace Encyclopedia\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CataloguesType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('category','entity', array('class' => 'EncyclopediaLibraryBundle:CataloguesCategories',
                                                        'property' => 'name',
                                                       ))
            ->add('idPerson','entity', array('class' => 'EncyclopediaLibraryBundle:Persons',
                                                        'property' => 'name',
                                                        'label' => 'Creator'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Encyclopedia\LibraryBundle\Entity\Catalogues'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_LibraryBundle_catalogues';
    }
}
