<?php

namespace App\Form;

use App\Entity\ImageGallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ImageGalleryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label' => 'Obrázek',
            ])
            ->add('imageName', TextType::class, [
                'label' => 'Změna názvu uloženého obrázku',
                'help'  => 'Pokud zadáte do pole název, tak se obrázek uloží pod zvoleným jménem.'
            ])
            ->add('imageTitle', TextType::class, [
                'label' => 'Alternativní název',
                'help'  => 'Název který se zobrazí, pokud se nepodaří obrázek na stránkách načíst. tzv alt tag alt="alternativní název"'
            ])
            ->add('imageOrder', NumberType::class, [
                'label' => 'Pořadí obrázků',
                'help'  => 'Řazení obrázků je v pořadí od 1 do 10 atd...'
            ])
            ->add('isActive')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ImageGallery::class,
        ]);
    }
}
