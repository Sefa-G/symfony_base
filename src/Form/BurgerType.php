<?php

namespace App\Form;

use App\Entity\Burger;
use App\Entity\Bread;
use App\Entity\Onion;
use App\Entity\Sauce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BurgerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name' , TextType::class , [
                'label' => 'Nom du burger'
            ])
            ->add('price' , TextType::class , [
                'label' => 'Prix'
            ])
            ->add('bread' , EntityType::class , [
                'class' => Bread::class,
                'required' => true,
                'choice_label' => 'type',
                'label' => 'Type de pain'
            ])
            ->add('onion', EntityType::class, [
                'label_attr'=>[
                    'class'=>'checkbox-inline',
                ],
                'expanded' => true,
                'class' => Onion::class,
                'required' => true,
                'multiple' => true,
                'choice_label' => 'type',
                'label'=> false,
            ])
            ->add('sauce', EntityType::class, [
                'label_attr'=>[
                    'class'=>'checkbox-inline',
                ],
                'expanded' => true,
                'class' => Sauce::class,
                'required' => true,
                'multiple' => true,
                'choice_label' => 'type',
                'label'=> false,
            ])
            ->add('image',FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => true
            ])
            ->add('Ajouter', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Burger::class,
        ]);
    }
}
