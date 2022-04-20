<?php

namespace App\Form;

use App\Entity\Garde;
use App\Entity\Service;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('uuid')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => "ROLE_USER",
                    'Administrateur' => "ROLE_ADMIN"
                ],
                'multiple' => true
            ])
            ->add('password', PasswordType::class)
            ->add('isadmin')
            ->add('level')
            ->add('visible')
            //->add('acctime')
            ->add('nom')
            ->add('prenom')
            ->add('titre')
            ->add('email')
            ->add('remark')
            ->add('gid', EntityType::class, [
                'class' => Garde::class,
                'choice_label' => 'nom'
            ])
            ->add('sid', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
