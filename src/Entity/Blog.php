<?php

namespace App\Entity;

use App\Entity\BasicEntity\BasicPage;
use App\Repository\BlogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog extends BasicPage
{
}