<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PageRepository;
use App\Entity\Trait\TimestampableTrait;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{

    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $shortBody = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $body = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Seo $seo = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?OGTags $ogTags = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isPublished = null;

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

    public function getShortBody(): ?string
    {
        return $this->shortBody;
    }

    public function setShortBody(string $shortBody): static
    {
        $this->shortBody = $shortBody;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public function getSeo(): ?Seo
    {
        return $this->seo;
    }

    public function setSeo(?Seo $seo): static
    {
        $this->seo = $seo;

        return $this;
    }

    public function getOgTags(): ?OGTags
    {
        return $this->ogTags;
    }

    public function setOgTags(?OGTags $ogTags): static
    {
        $this->ogTags = $ogTags;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setPublished(?bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}
