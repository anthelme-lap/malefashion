<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullname',null, ['label' => 'Nom','attr' =>['class' => 'form-control-user']])
            ->add('ville',null, ['label' => 'Ville','attr' =>['class' => 'form-control-user']])
            ->add('quartier',null, [ 'label' => 'Quartier','attr' =>['class' => 'form-control-user']])
            ->add('phone',null, ['label' => 'Téléphone','attr' =>['class' => 'form-control-user']])
            ->add('description',null, ['label' => 'Description','attr' =>['class' => 'form-control-user']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
