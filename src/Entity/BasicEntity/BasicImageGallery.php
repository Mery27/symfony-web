<?php

declare(strict_types=1);

namespace App\Entity\BasicEntity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;

#[MappedSuperclass]
class BasicImageGallery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageTitle = null;

    #[ORM\Column(type:'integer', nullable: true)]
    protected $imageOrder = null;

    #[ORM\Column]
    private ?bool $isActive = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): static
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageTitle(): ?string
    {
        return $this->imageTitle;
    }

    public function setImageTitle(?string $imageTitle): static
    {
        $this->imageTitle = $imageTitle;

        return $this;
    }

    public function getImageOrder(): ?int
    {
        return $this->imageOrder;
    }

    public function setImageOrder(int $imageOrder): self
    {
        $this->imageOrder = $imageOrder;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }
}