<?php

namespace App\Form;

use App\Entity\OgTags;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OgTagsFormType extends AbstractType
{

    public function __construct(
        private ContainerBagInterface $params,
    ){
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $pageName = $this->params->get('page_name');
        $locale = $this->params->get('default_locale');

        $builder
            ->add('title', null, [
                'help' => 'Vše o og:tags (Open Graph meta značky) se dozvíte zde <a href="https://www.vzhurudolu.cz/prirucka/meta-open-graph" target="_blank">og značky</a>'
            ])
            ->add('description')
            ->add('url')
            ->add('image')
            ->add('type')
            ->add('locale', TextType::class, [
                'empty_data' => $locale,
                'attr' => [
                    'placeholder' => $locale
                ]
            ])
            ->add('siteName', TextType::class, [
                'empty_data' => $pageName,
                'attr' => [
                    'placeholder' => $pageName
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OgTags::class,
        ]);
    }
}
