<?php

namespace AppBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ProductType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('name', TextType::class)
        ->add('description', TextType::class)
        ->add('price', TextType::class )
            ->add('save', SubmitType ::class, [
                'label'=> 'Save',
                 'attr' => [
                     'class' => 'btn btn-success'
                 ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(['data_class'=> 'AppBundle\Entity\Product']);
    }

}