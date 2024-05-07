<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: 'brands')]
#[ORM\HasLifecycleCallbacks]
class Brand extends BaseEntity
{
    #[ORM\Column(type: 'string')]
    public string $name;

    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'brand')]
    public Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function attachProduct(Product $product): void
    {
        $this->products[] = $product;
    }
    public function getProducts(): Collection
    {
        return $this->products;
    }
}
