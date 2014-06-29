<?php

namespace Encyclopedia\AdminBundle\Form;

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
            ->add('author')
            ->add('publisher')
            ->add('classification')
            ->add('typeNumber')
            ->add('refNumber')
            ->add('languages','entity',array('class' => 'EncyclopediaAdminBundle:Lang',
                                             'property' => 'name'))
            ->add('oeuvres','entity',array('class' => 'EncyclopediaAdminBundle:Oeuvres',
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
            'data_class' => 'Encyclopedia\AdminBundle\Entity\Publishing'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_adminbundle_publishing';
    }
}
