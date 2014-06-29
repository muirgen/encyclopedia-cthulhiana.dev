<?php

namespace Encyclopedia\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PublishingType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('subtitle')
            ->add('author')
            ->add('collection')
            ->add('collectionNumber')
            ->add('publisher')
            ->add('publishDate')
            ->add('publishYear')
            ->add('classification')
            ->add('typeNumber')
            ->add('refNumber')
            ->add('comments', 'textarea', array('required' => false))
            ->add('languages','entity',array('class' => 'EncyclopediaLibraryBundle:Lang',
                                             'property' => 'name'))
            ->add('oeuvres','entity',array('class' => 'EncyclopediaLibraryBundle:Oeuvres',
                                            'property' => 'oeuvreAndFormat',
                                            'multiple' => true))    
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Encyclopedia\LibraryBundle\Entity\Publishing'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_LibraryBundle_publishing';
    }
}
