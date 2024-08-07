<?php

declare(strict_types=1);

namespace App\Entity\Trait;

use App\Entity\Seo;

trait SeoFormCollectionFieldTrait
{
    use OneFormCollectionFieldTrait;
    
        /**
     * Change for one form collection field in crud controller
     * which extends basic getter and setter
     */
    public function getSeoCrud(): ?array
    {
        return $this->objectInArray($this->seo);
    }

    /**
     * Change for one form collection field in crud controller
     * which extends basic getter and setter
     */
    public function setSeoCrud(Seo|array|null $seo): static
    {
        $this->seo = $this->arrayToDefaultValue($seo);

        return $this;
    }
}
