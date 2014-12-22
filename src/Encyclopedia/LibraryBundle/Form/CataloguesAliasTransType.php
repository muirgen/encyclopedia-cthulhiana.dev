<?php

namespace Encyclopedia\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CataloguesAliasTransType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isocode')
            ->add('nameTrans')
            ->add('alias')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Encyclopedia\LibraryBundle\Entity\CataloguesAliasTrans'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_librarybundle_cataloguesaliastrans';
    }
}
