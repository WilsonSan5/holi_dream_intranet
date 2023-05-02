<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\Categorie;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('introduction', TextareaType::class)
            ->add('description')
            ->add('prixDefaut')
            ->add('descriptionProgramme')
            ->add('image', FileType::class, [
                'label' => 'Image (jpg,jpeg,webp)',

                'mapped' => false,
                'required' => false,

                'constraints' => [
                    new File([

                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/webp'
                        ],
                        'mimeTypesMessage' => 'Format d\'image non pris en charge',
                    ])
                ],
            ])
            ->add(
                'categorie', EntityType::class,
                [
                    'class' => Categorie::class,
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'expanded' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}