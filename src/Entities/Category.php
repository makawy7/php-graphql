<?php

namespace App\Entities;

use App\Repositories\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'categories')]
#[ORM\HasLifecycleCallbacks]
class Category extends BaseEntity
{
    #[ORM\Column(type: 'string')]
    public string $name;

    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'category')]
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
