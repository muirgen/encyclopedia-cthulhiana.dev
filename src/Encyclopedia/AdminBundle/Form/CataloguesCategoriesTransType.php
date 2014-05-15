<?php

namespace Encyclopedia\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CataloguesCategoriesTransType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameTrans')
            ->add('category','entity', array('class' => 'EncyclopediaAdminBundle:CataloguesCategories',
                                                'property' => 'name'))
            ->add('lang', 'entity', array('class' => 'EncyclopediaAdminBundle:Lang',
                                            'property' => 'name'))   
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Encyclopedia\AdminBundle\Entity\CataloguesCategoriesTrans'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_adminbundle_cataloguescategoriestrans';
    }
}
