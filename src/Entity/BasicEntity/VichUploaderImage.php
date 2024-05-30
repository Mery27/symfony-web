<?php

declare(strict_types=1);

namespace App\Entity\BasicEntity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping\MappedSuperclass;

#[MappedSuperclass]
#[Vich\Uploadable]
class VichUploaderImage
{
    /*
    * NOTE: This is not a mapped field of entity metadata, just a simple property.
    * mapping = name in vich_uploader yaml file on mappings section.
    * fileNameProperty = connection to the variable on this file.
    *   
    * Using global mappings 'images' for all images without specification his directory
    * For change create new mappings and rewrite this variable.
    */
    #[Vich\UploadableField(mapping: 'images', fileNameProperty: 'image')]
    protected ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    protected ?string $image = null;

    #[ORM\Column(nullable: true)]
    protected ?\DateTimeImmutable $updatedAt = null;

    public function __construct() {
        $this->updatedAt = new \DateTimeImmutable();
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Get the value of updatedAt
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @return  self
     */ 
    public function setUpdatedAt($updatedAt = null)
    {

        if (! $updatedAt) {
            $this->updatedAt = new \DateTimeImmutable();
        } else {
            $this->updatedAt = $updatedAt;
        }

        return $this;
    }
}