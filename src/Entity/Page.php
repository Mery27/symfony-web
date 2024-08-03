<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PageRepository;
use App\Entity\Trait\TimestampableTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: PageRepository::class)]
#[UniqueEntity('url', 'Tato "{{ value }}" url adresa se už používá. Zadejte prosím jinou.')]
#[ORM\HasLifecycleCallbacks]
class Page
{

    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $shortBody = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $body = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], targetEntity: Seo::class)]
    private ?Seo $seo = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], targetEntity: OGTags::class)]
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

    public function getSeo(): Seo|array|null
    {
        return $this->seo;
    }

    public function setSeo(Seo|array|null $seo): static
    {
        // if (is_array($seo)) {
        //     $seo = $seo[0];
        // }

        $this->seo = $seo;

        return $this;
    }

    // Hack to use CollectionField in PageCrudController, which work with collection array
    public function getSeoCrud(): ?array
    {
        return $this->seo ? [$this->seo] : [];
    }

    public function setSeoCrud(Seo|array|null $seo): static
    {
        if (is_array($seo)) {
            $seo = $seo[0];
        }

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

    // Hack to use CollectionField in PageCrudController, which work with collection array
    public function getOgTagsCrud(): ?array
    {
        return $this->ogTags ? [$this->ogTags] : [];
    }

    public function setOgTagsCrud(OGTags|array|null $ogTags): static
    {
        if (is_array($ogTags)) {
            $ogTags = $ogTags[0];
        }

        $this->ogTags = $ogTags;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(?bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}
