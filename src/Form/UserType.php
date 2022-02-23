<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('uuid')
            ->add('roles')
            ->add('password')
            ->add('isadmin')
            ->add('level')
            ->add('visible')
            ->add('acctime')
            ->add('nom')
            ->add('prenom')
            ->add('titre')
            ->add('email')
            ->add('remark')
            ->add('gid')
            ->add('sid')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
