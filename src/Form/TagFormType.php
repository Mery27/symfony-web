<?php

namespace App\Form;

use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TagFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Název štítku',
            ])
            ->add('url', TextType::class, [
                'label' => 'URL adresa štítku',
                'help' => 'URL adresa pod kterou se zobrazí vše spadající pod daný štítek, články, produkty ...'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Popis štítku',
                'attr' => [
                    'rows' => 4,
                ],
                'help' => 'Krátky popis příslušného tagu, který se zobrazí na uvodu stránky.'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tag::class,
        ]);
    }
}
