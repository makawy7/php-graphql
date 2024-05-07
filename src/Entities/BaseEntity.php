<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

class BaseEntity implements \ArrayAccess
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public int|null $id;

    #[ORM\Column(type: 'datetime')]
    public \DateTime $createdAt;

    #[ORM\Column(type: 'datetime')]
    public \DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = $this->createdAt;
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->updatedAt = new \DateTime('now');
    }

    // Array Access
    public function offsetExists($offset): bool
    {
        return isset($this->$offset);
    }

    public function offsetSet($offset, $value): void
    {
        $this->$offset = $value;
    }

    public function offsetGet($offset): mixed
    {
        return $this->$offset;
    }

    public function offsetUnset($offset): void
    {
        $this->$offset = null;
    }
}
