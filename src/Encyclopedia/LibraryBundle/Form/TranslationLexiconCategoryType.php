<?php

namespace Encyclopedia\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Encyclopedia\LibraryBundle\Form\Custom\EntityHiddenFieldType;

class TranslationLexiconCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('translation')
            ->add('category', 'entity_hidden', array('class' => 'Encyclopedia\LibraryBundle\Entity\LexiconCategory'))
            ->add('language','entity', array('class' => 'EncyclopediaLibraryBundle:Language',
                                            'property' => 'language'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Encyclopedia\LibraryBundle\Entity\TranslationLexiconCategory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_librarybundle_translationlexiconcategory';
    }
}
