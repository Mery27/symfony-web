<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Form\SeoFormType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }
    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title');
        $url = TextField::new('url');
        $description = TextEditorField::new('description');

        $seo = CollectionField::new('seoCrud', 'SEO')
            ->addCssClass('only-one-form-in-collection')
            ->allowAdd(true)
            ->renderExpanded()
            ->allowDelete(false)
            ->setEntryIsComplex(true)
            ->setEntryType(SeoFormType::class);

        if (Action::INDEX === $pageName) {
            return [
                $title->setTemplatePath('admin/crud_fields/title_with_url_field.html.twig'),
                $description->setTemplatePath('admin/crud_fields/modal_text_field.html.twig'),
                $seo->setTemplatePath('admin/crud_fields/page/seo_modal_collection_field.html.twig'),
            ];
        }

        if (Action::NEW === $pageName || Action::EDIT === $pageName) {
            return [
                FormField::addTab('Nastavení'),
                $title,
                $url,
                $description,
                FormField::addTab('Seo'),
                $seo,
            ];
        }

        return [
            $title,
            $url,
            $description,
            $seo,
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->showEntityActionsInlined()
        ->setPageTitle(Crud::PAGE_INDEX, 'Seznam štítků')
        ->setPageTitle(Crud::PAGE_EDIT, 'Upravit štítek')
        ->setPageTitle(Crud::PAGE_NEW, 'Vytvořit štítek')
        ->setEntityLabelInSingular('Štítek')
        ->setDefaultSort(['title' => 'DESC'])
        ;
    }

    public function configureActions(Actions $actions): Actions
    {

        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Vytvořit článek');
            })
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
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
