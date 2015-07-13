<?php

namespace Encyclopedia\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Encyclopedia\LibraryBundle\Form\Custom\EntityHiddenFieldType;

class LexiconAliasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('termAlias','text')
            ->add('idxTermAlias','text')
            ->add('lexicon','entity_hidden', array('class' => 'Encyclopedia\LibraryBundle\Entity\Lexicon'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Encyclopedia\LibraryBundle\Entity\LexiconAlias'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_librarybundle_lexiconalias';
    }
}
