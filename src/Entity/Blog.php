<?php

namespace App\Entity;

use App\Entity\BasicEntity\BasicPage;
use App\Repository\BlogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog extends BasicPage
{
    #[ORM\ManyToOne(inversedBy: 'blogs')]
    private ?BlogCategory $category = null;

    /**
     * @var Collection<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'blogs', cascade: ['persist', 'detach'])]
    private Collection $tag;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?BlogImage $image = null;

    /**
     * @var Collection<int, BlogImageGallery>
     */
    #[ORM\OneToMany(targetEntity: BlogImageGallery::class, mappedBy: 'blog', cascade: ['persist', 'remove'])]
    private Collection $imageGallery;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->imageGallery = new ArrayCollection();
    }

    public function getCategory(): ?BlogCategory
    {
        return $this->category;
    }

    public function setCategory(?BlogCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tag->contains($tag)) {
            $this->tag->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tag->removeElement($tag);

        return $this;
    }

    public function getImage(): ?BlogImage
    {
        return $this->image;
    }

    public function setImage(?BlogImage $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, BlogImageGallery>
     */
    public function getImageGallery(): Collection
    {
        return $this->imageGallery;
    }

    public function addImageGallery(BlogImageGallery $imageGallery): static
    {
        if (!$this->imageGallery->contains($imageGallery)) {
            $this->imageGallery->add($imageGallery);
            $imageGallery->setBlog($this);
        }

        return $this;
    }

    public function removeImageGallery(BlogImageGallery $imageGallery): static
    {
        if ($this->imageGallery->removeElement($imageGallery)) {
            // set the owning side to null (unless already changed)
            if ($imageGallery->getBlog() === $this) {
                $imageGallery->setBlog(null);
            }
        }

        return $this;
    }
}