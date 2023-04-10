<?php

namespace App\Form;

use App\Entity\Planning;
use App\Repository\ProduitRepository;
use Proxies\__CG__\App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PlanningType extends AbstractType
{   

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateDepart', DateType::class,[
                'widget' => 'single_text'
            ])
            ->add('DateFin', DateType::class,[
                'widget' => 'single_text'
            ])
            ->add('prix')
            ->add('produit', EntityType::class,[
                'class' => Produit::class,
                'choice_label' => 'title',
                'placeholder' => 'caca'
            ])
            ->add('quantite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planning::class,
        ]);
    }
}
