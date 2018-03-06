<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class , [
                "label"=> "votre idée : ",
                'attr' => [
                    'class' => 'validate'
                ]
            ])
            ->add('detail',TextareaType::class,  [
                "label"=> "Votre critique : ",
                'attr' => [
                    'class' => 'materialize-textarea'
                ]
            ])
             ->add('sauvegarder',SubmitType::class, array(
                'attr' => array(
                'class' => 'btn waves-effect waves-light'),
              ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Review'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_review';
    }


}
