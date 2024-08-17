<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Admin\Field\EmbededFormField;
use App\Form\BlogImageGalleryFormType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class BlogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blog::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IdField::new('id', 'ID')->setDisabled();
        $title = TextField::new('title', 'Název článku');
        $url = TextField::new('url', 'URL adresa článku');
        $image = EmbededFormField::new('image', 'Obrázek')
            ->setTemplatePath('admin/crud_fields/image_field.html.twig');
        $imageGallery = CollectionField::new('imageGallery', 'Obrázková galerie')
            ->setEntryType(BlogImageGalleryFormType::class);
        $shortBody = TextEditorField::new('shortBody', 'Úvodní text');
        $body = TextEditorField::new('body', 'Obsah článku');
        $updatedAt = DateTimeField::new('updatedAt', 'Aktualizováno');
        $createdAt = DateTimeField::new('createdAt', 'Vytvořeno');
        $isPublished = BooleanField::new('isPublished', 'Aktivní');
        $category = AssociationField::new('category', 'Kategorie')
            ->autocomplete();
        $tag = AssociationField::new('tag', 'Štítky')
            ->autocomplete();
        $seo = EmbededFormField::new('seo');
        $ogTags = EmbededFormField::new('ogTags');

        if (Action::EDIT === $pageName || Action::NEW === $pageName) {
            return [
                FormField::addTab('Nastavení'),
                $title,
                $url,
                $shortBody,
                $category,
                $tag,
                $updatedAt,
                $createdAt,
                $isPublished,
                FormField::addTab('Obrázky'),
                FormField::addFieldset('Obrázek')
                    ->setHelp('Jedná se o hlavní obrázek článku.')
                    ->setIcon('image'),
                $image,
                FormField::addFieldset('Galerie obrázků')
                    ->setHelp('Galerie obrázku ke článku.')
                    ->setIcon('images'),
                $imageGallery,
                FormField::addTab('Obsah'),
                $body,
                FormField::addTab('Seo'),
                $seo,
                FormField::addTab('OG tags'),
                $ogTags,
                FormField::addTab('ID'),
                $id,
            ];
        }

        if (Action::INDEX === $pageName) {
            return [
                $title->setTemplatePath('admin/crud_fields/title_with_url_field.html.twig'),
                $image,
                $imageGallery->setTemplatePath('admin/crud_fields/modal_collection_field.html.twig')->setLabel('Fotogalerie'),
                $shortBody->setTemplatePath('admin/crud_fields/modal_text_field.html.twig'),
                $body->setTemplatePath('admin/crud_fields/modal_text_field.html.twig'),
                $seo,
                $ogTags,
                $updatedAt->setTemplatePath('admin/crud_fields/timestampable_field.html.twig'),
                $isPublished,
            ];
        }

        return [];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->showEntityActionsInlined()
        ->setPageTitle(Crud::PAGE_INDEX, 'Seznam článků')
        ->setPageTitle(Crud::PAGE_EDIT, 'Upravit článek')
        ->setPageTitle(Crud::PAGE_NEW, 'Vytvořit článek')
        ->setEntityLabelInSingular('Článek')
        ->setDefaultSort(['createdAt' => 'DESC'])
        ->setDateTimeFormat($this->getParameter('date_format_long'))
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        // Rewrite default Detail action to redirect to the app_page_show route
        $showAction = Action::new('detail', 'Zobrazit')
            ->linkToRoute('app_blog_show', function (Blog $blog): array {
                return [
                    'url' =>  $blog->getUrl(),
                ];
            });

        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Vytvořit článek');
            })
            ->add(Crud::PAGE_INDEX, $showAction)
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon('fas fa-eye')->setLabel(false)->addCssClass('text-secondary')->setHtmlAttributes(['title' => 'Zobrazit']);
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fas fa-edit')->setLabel(false)->addCssClass('text-warning')->setHtmlAttributes(['title' => 'Upravit']);
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa-solid fa-trash-can')->setLabel(false)->addCssClass('text-danger')->setHtmlAttributes(['title' => 'Smazat']);
            })
        ;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ;
    }
}

