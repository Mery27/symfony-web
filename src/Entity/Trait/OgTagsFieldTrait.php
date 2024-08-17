<?php

declare(strict_types=1);

namespace App\Entity\Trait;

use App\Entity\OgTags;
use Doctrine\ORM\Mapping as ORM;

trait OgTagsFieldTrait
{
    #[ORM\OneToOne(cascade: ['persist', 'remove'], targetEntity: OgTags::class)]
    private ?OgTags $ogTags = null;

    public function getOgTags(): ?OgTags
    {
        return $this->ogTags;
    }

    public function setOgTags(?OgTags $ogTags): static
    {
        $this->ogTags = $ogTags;

        return $this;
    }
}