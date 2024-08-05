<?php

namespace App\Entity;

use App\Entity\BasicEntity\BasicPage;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PageRepository;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page extends BasicPage
{
}