<?php

declare(strict_types=1);

namespace App\Entity\Trait;

use App\Entity\OGTags;

trait OGTagsFormCollectionFieldTrait
{
    use OneFormCollectionFieldTrait;
    
        /**
     * Change for one form collection field in crud controller
     * which extends basic getter and setter
     */
    public function getOgTagsCrud(): ?array
    {
        return $this->objectInArray($this->ogTags);
    }

    /**
     * Change for one form collection field in crud controller
     * which extends basic getter and setter
     */
    public function setOgTagsCrud(OGTags|array|null $ogTag): static
    {
        $this->ogTags = $this->arrayToDefaultValue($ogTag);

        return $this;
    }
}
