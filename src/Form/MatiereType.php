<?php

namespace App\Form;

use App\Entity\Matiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\EasyAdminFormType;

class MatiereType extends EasyAdminFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom_matiere')
            ->add('NhTHC')
            ->add('NhTD')
            ->add('NhTP')
            ->add('coefMatiere')
            ->add('Niveau')
            ->add('semestre')
            ->add('NhTotal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Matiere::class,
        ]);
    }
}
