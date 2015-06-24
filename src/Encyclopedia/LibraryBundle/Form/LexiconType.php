<?php

namespace Encyclopedia\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LexiconType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('term','text')
            ->add('idxTerm','text')
            ->add('category', 'entity', array('class' => 'Encyclopedia\LibraryBundle\Entity\LexiconCategory',
                'choice_label' => 'category'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Encyclopedia\LibraryBundle\Entity\Lexicon'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'encyclopedia_librarybundle_lexicon';
    }
}
