<?php

namespace App\Form;

use App\Entity\BlogImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageFormType extends AbstractType
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
            ->add('isActive')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlogImage::class,
        ]);
    }
}
