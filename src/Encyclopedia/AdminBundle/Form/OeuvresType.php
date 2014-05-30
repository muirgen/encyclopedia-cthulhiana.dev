<?php

namespace Encyclopedia\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OeuvresType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('date', 'text', array('max_length' => 4))
            ->add('format','choice',array('choices' => array('Short Story' => 'Short Story',
                                                             'Novel' => 'Novel',
                                                             'Movie' => 'Movie',
                                                             'Encyclopedia' => 'Encyclopedia'),
                                          'required' => true));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Encyclopedia\AdminBundle\Entity\Oeuvres'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_adminbundle_oeuvres';
    }
}
