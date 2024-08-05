<?php

namespace App\Entity;

use App\Entity\BasicEntity\BasicTag;
use App\Repository\TagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag extends BasicTag
{
}