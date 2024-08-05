<?php

namespace App\Entity;

use App\Entity\BasicEntity\BasicImageGallery;
use App\Repository\BlogImageGalleryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogImageGalleryRepository::class)]
class BlogImageGallery extends BasicImageGallery
{
    #[ORM\ManyToOne(inversedBy: 'imageGallery')]
    private ?Blog $blog = null;

    public function getBlog(): ?Blog
    {
        return $this->blog;
    }

    public function setBlog(?Blog $blog): static
    {
        $this->blog = $blog;

        return $this;
    }
}
