<?php

namespace App\Form;

use App\Entity\Seo;
use Symfony\Component\Form\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SeoFormType extends AbstractType
{
    public function __construct(
        private ContainerBagInterface $params
    ){
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $author = $this->params->get('page_name');

        $builder
            ->add('title', null, [
                'help' => 'Délka 50-60 znaků, který se zobrazjí, max 70. Klíčové slova co nejvíce v levé straně. Pro každou stránku unikátní a nejlépe se shodující s nadpisem H1.<a href="https://www.seoprakticky.cz/slovnik-pojmu/title-tag/" target="_blank">více informací</a>'
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => 4,
                ],
                'help' => 'Nepoužívá se v algoritmech pro vyhodnocování stránky. Maximální délka 160 znaků, jedinečný pro každou stránku. Mělo by se jednat o stručné shrnutí obsahu vaší stránky. <a href="https://www.seoprakticky.cz/slovnik-pojmu/meta-description/" target="_blank">více infomací</a>'
            ])
            ->add('keywords')
            ->add('author', TextType::class, [
                'empty_data' => $author,
                'attr' => [
                    'placeholder' => $author
                ]
            ])
            ->add('robots', TextType::class, [
                'empty_data' => 'index, follow',
                'attr' => [
                    'placeholder' => 'index, follow'
                ],
                'help' => 'index, follow, noindex, nofollow, all (index, follow) <a href="https://napoveda.seznam.cz/cz/meta-tag-robots/" target="_blank"> více informací</a>'
            ])
            ->add('canonical', TextType::class, [
                'help' => '<a href="https://napoveda.seznam.cz/cz/fulltext-hledani-v-internetu/kanonicke-url/" target="_blank"> více informací</a>'
            ])
            ->add('hideInSitemap', null, [
                'label' => 'Schovat v sitemap.xml'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Seo::class,
        ]);
    }
}
