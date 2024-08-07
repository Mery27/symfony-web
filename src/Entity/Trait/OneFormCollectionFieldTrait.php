<?php

declare(strict_types=1);

namespace App\Entity\Trait;

trait OneFormCollectionFieldTrait
{
    /**
     * HOOK Use for OneToOne collection field in easyadmin crud controller
     * 
     * For collection field in crud controller which must have only one form,
     * we need convert array back to the object or null.
     * We accept only first element from array collection.
     */
    private function arrayToDefaultValue(object|array|null $element): ?object
    {
        if (is_array($element)) {
             return !empty($element) ? $element[0] : null;
        }

        return $element;
    }

    /**
     * HOOK Use for OneToOne collection field in easyadmin crud controller
     * 
     * For collection field in crud controller which must have only one form.
     * When we need load object for edit form, we must return object in array.
     */
    private function objectInArray(?object $object): ?array
    {
        return $object ? [$object] : [];
    }
}
