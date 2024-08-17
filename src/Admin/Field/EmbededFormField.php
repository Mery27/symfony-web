<?php

declare(strict_types=1);

namespace App\Admin\Field;

use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;

final class EmbededFormField implements FieldInterface
{
    use FieldTrait;

    public static function new(string $propertyName, ?string $label = null)
    {
        $formType = ucfirst($propertyName) . 'FormType';
        $template = strtolower($propertyName);

        return (new self())
            ->setProperty($propertyName)
            ->setLabel($label)
            ->addCssClass('embeded-form-field')
            ->setFormType('App\Form\\' . $formType)
            ->setTemplatePath('admin/crud_fields/page/' . $template . '_modal_collection_field.html.twig')
            ->addCssFiles('styles/admin/embeded-form-field.css')
            ->addJsFiles('js/admin/show-fields-length.js')
            ;
    }
}
