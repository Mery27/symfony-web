<?php

namespace App\Entity\BasicEntity;

use App\Entity\Seo;
use App\Entity\OGTags;
use App\Entity\Trait\OGTagsFormCollectionFieldTrait;
use App\Entity\Trait\SeoFormCollectionFieldTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\TimestampableTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping\MappedSuperclass;

#[MappedSuperclass]
#[UniqueEntity('url', 'Tato "{{ value }}" url adresa se už používá. Zadejte prosím jinou.')]
#[ORM\HasLifecycleCallbacks]
class BasicPage
{

    use TimestampableTrait;
    use SeoFormCollectionFieldTrait;
    use OGTagsFormCollectionFieldTrait;

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

    public function setIsPublished(?bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}
