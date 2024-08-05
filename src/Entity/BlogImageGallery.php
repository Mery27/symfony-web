<?php

namespace App\Entity;

use App\Entity\BasicEntity\BasicImageGallery;
use App\Repository\BlogImageGalleryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogImageGalleryRepository::class)]
class BlogImageGallery extends BasicImageGallery
{
}
