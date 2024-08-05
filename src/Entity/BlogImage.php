<?php

namespace App\Entity;

use App\Entity\BasicEntity\BasicImage;
use App\Repository\BlogImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogImageRepository::class)]
class BlogImage extends BasicImage
{
}
