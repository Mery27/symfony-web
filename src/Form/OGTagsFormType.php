<?php

namespace App\Form;

use App\Entity\OGTags;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OGTagsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('locale')
            ->add('type')
            ->add('title')
            ->add('description')
            ->add('url')
            ->add('siteName')
            ->add('image')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OGTags::class,
        ]);
    }
}
