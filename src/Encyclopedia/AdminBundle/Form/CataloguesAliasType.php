<?php

namespace Encyclopedia\AdminBundle\Form;

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
            ->add('country','choice', array('choices' => array('fr' => 'fr',
                                                                'en' => 'en' )))
            ->add('description','textarea', array('required' => false))
            ->add('note', 'textarea', array('required' => false))
            ->add('id_catalogue','entity', array('class' => 'EncyclopediaAdminBundle:Catalogue',
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
            'data_class' => 'Encyclopedia\AdminBundle\Entity\CatalogueAlias'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_adminbundle_cataloguealias';
    }
}
