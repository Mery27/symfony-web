<?php

declare(strict_types=1);

namespace App\Entity\Trait;

use App\Entity\Seo;
use Doctrine\ORM\Mapping as ORM;

trait SeoFieldTrait
{
    #[ORM\OneToOne(cascade: ['persist', 'remove'], targetEntity: Seo::class)]
    private ?Seo $seo = null;

    public function getSeo(): ?Seo
    {
        return $this->seo;
    }

    public function setSeo(?Seo $seo): static
    {
        $this->seo = $seo;

        return $this;
    }
}