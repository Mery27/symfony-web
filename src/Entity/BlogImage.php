<?php

namespace App\Entity;

use App\Entity\BasicEntity\BasicImage;
use App\Repository\BlogImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: BlogImageRepository::class)]
class BlogImage extends BasicImage
{
    #[Vich\UploadableField(mapping: 'blog_image', fileNameProperty: 'image')]
    protected ?File $imageFile = null;
}
