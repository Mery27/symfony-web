<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Form\SeoFormType;
use App\Form\OGTagsFormType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IdField::new('id', 'ID')->setDisabled();
        $title = TextField::new('title', 'Název stránky');
        $url = TextField::new('url', 'URL adresa stránky');
        $shortBody = TextEditorField::new('shortBody', 'Úvodní text');
        $body = TextEditorField::new('body', 'Obsah stránky');
        $updatedAt = DateTimeField::new('updatedAt', 'Aktualizováno');
        $createdAt = DateTimeField::new('createdAt', 'Vytvořeno');
        $isPublished = BooleanField::new('isPublished', 'Aktivní');

        $seo = CollectionField::new('seoCrud', 'SEO')
            ->addCssClass('only-one-form-in-collection')
            ->allowAdd(true)
            ->renderExpanded()
            ->allowDelete(false)
            ->setEntryIsComplex(true)
            ->setEntryType(SeoFormType::class);

        $ogTags = CollectionField::new('ogTagsCrud', 'OG tags')
            ->addCssClass('only-one-form-in-collection')
            ->allowAdd(true)
            ->renderExpanded()
            ->allowDelete(false)
            ->setEntryIsComplex(true)
            ->setEntryType(OGTagsFormType::class);
        
        if (Action::EDIT === $pageName || Action::NEW === $pageName) {
            return [
                FormField::addTab('Nastavení'),
                $title,
                $url,
                $shortBody,
                $updatedAt,
                $createdAt,
                $isPublished,
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
                $shortBody->setTemplatePath('admin/crud_fields/modal_text_field.html.twig'),
                $body->setTemplatePath('admin/crud_fields/modal_text_field.html.twig'),
                $seo->setTemplatePath('admin/crud_fields/page/seo_modal_collection_field.html.twig'),
                $ogTags->setTemplatePath('admin/crud_fields/page/ogtags_modal_collection_field.html.twig'),
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
        ->setPageTitle(Crud::PAGE_INDEX, 'Seznam stránek')
        ->setPageTitle(Crud::PAGE_EDIT, 'Upravit stránku')
        ->setEntityLabelInSingular('Stránka')
        ->setDefaultSort(['createdAt' => 'DESC'])
        ->setDateTimeFormat($this->getParameter('date_format_long'))
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        // Rewrite default Detail action to redirect to the app_page_show route
        $showAction = Action::new('detail', 'Zobrazit')
            ->linkToRoute('app_page_show', function (Page $page): array {
                return [
                    'url' => $page->getUrl(),
                ];
            });

        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Vytvořit stránku');
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
            ->addAssetMapperEntry('one-form-collection-field')
            ;
    }
}
