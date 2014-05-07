<?php

namespace Encyclopedia\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CatalogueType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('category','entity', array('class' => 'EncyclopediaAdminBundle:CatalogueCategories',
                                                        'property' => 'name',
                                                       ))
            ->add('id_person','entity', array('class' => 'EncyclopediaAdminBundle:Persons',
                                                        'property' => 'name',
                                                       ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Encyclopedia\AdminBundle\Entity\Catalogue'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_adminbundle_catalogue';
    }
}
