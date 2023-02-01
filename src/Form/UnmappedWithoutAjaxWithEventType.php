<?php

namespace App\Form;

use App\Entity\Group;
use App\Entity\Person;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnmappedWithoutAjaxWithEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $data = $options['group'];

        $builder
            ->add('name')
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                function(FormEvent $event) use ($data){
                $form = $event->getForm();

                $form->add('personGroup',EntityType::class,[
                    'class' => Group::class,
                    'autocomplete' => true,
                    'mapped' => false,
                    'data' => $data
                ]);
            })
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
