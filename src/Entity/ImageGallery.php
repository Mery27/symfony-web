<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\BasicEntity\BasicImageGallery;
use App\Repository\ImageGalleryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageGalleryRepository::class)]
class ImageGallery extends BasicImageGallery
{

}
