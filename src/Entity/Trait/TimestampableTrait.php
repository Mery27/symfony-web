<?php

declare(strict_types=1);

namespace App\Entity\Trait;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
trait TimestampableTrait
{
    /**
     * @var DateTime datum vytvoření stránky
     */
    #[ORM\Column(type: 'datetime', nullable: true)]
    private $createdAt;

    /**
     * @var DateTime datum poslední úpravy stránky
     */
    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updatedTimestamps(): void
    {
        $dateNow = new DateTime('now');

        $this->updatedAt = $dateNow;

        if ($this->createdAt == null) {
            $this->setCreatedAt($dateNow);
        }
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
