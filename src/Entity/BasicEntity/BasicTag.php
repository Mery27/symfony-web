<?php

declare(strict_types=1);

namespace App\Entity\BasicEntity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\SeoFieldTrait;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[MappedSuperclass]
#[UniqueEntity('url', 'Tato "{{ value }}" url adresa se už používá. Zadejte prosím jinou.')]
class BasicTag
{
    use SeoFieldTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function __tostring(): string
    {
        return $this->title . ' - id: ' . (string) $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
