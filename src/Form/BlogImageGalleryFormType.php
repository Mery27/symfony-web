<?php

namespace App\Form;

use App\Entity\BlogImageGallery;
use App\Form\ImageGalleryFormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogImageGalleryFormType extends ImageGalleryFormType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlogImageGallery::class,

        ]);
    }
}
