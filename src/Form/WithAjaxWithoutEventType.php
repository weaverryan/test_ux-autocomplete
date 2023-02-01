<?php

namespace App\Form;

use App\Entity\Group;
use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WithAjaxWithoutEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $data = $options['group'];

        $builder
            ->add('name')
            ->add('personGroup',GroupAutocompleteField::class,[
                'data' => $data
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
            'group' => null
        ]);
    }
}
