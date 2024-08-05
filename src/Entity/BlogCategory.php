<?php

namespace App\Entity;

use App\Entity\BasicEntity\BasicCategory;
use App\Repository\BlogCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogCategoryRepository::class)]
class BlogCategory extends BasicCategory
{
}