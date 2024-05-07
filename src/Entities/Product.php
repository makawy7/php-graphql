<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repositories\ProductRepository;

#[ORM\Entity]
#[ORM\Table(name: 'products')]
#[ORM\HasLifecycleCallbacks]
class Product extends BaseEntity
{
    #[ORM\Column(type: 'string')]
    public string $name;

    #[ORM\Column(type: 'string', unique: true)]
    public string $slug;

    #[ORM\Column(type: 'boolean')]
    public bool $inStock = true;

    #[ORM\Column(type: 'text')]
    public string $description;

    #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: 'products')]
    public Brand|null $brand;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    public Category|null $category;

    #[ORM\OneToMany(targetEntity: Gallery::class, mappedBy: 'product')]
    public Collection $galleries;

    #[ORM\OneToMany(targetEntity: Price::class, mappedBy: 'product')]
    public Collection $prices;

    #[ORM\ManyToMany(targetEntity: AttributeSet::class, inversedBy: 'products')]
    public Collection $attributeSets;

    public function __construct()
    {
        $this->galleries = new ArrayCollection;
        $this->prices = new ArrayCollection;
        $this->attributeSets = new ArrayCollection;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
    public function getSlug(): string
    {
        return $this->slug;
    }
    public function isInStock(): bool
    {
        return $this->inStock;
    }
    public function setIsInStock(bool $inStock): void
    {
        $this->inStock = $inStock;
    }

    // Description
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public function getDescription(): string
    {
        return $this->description;
    }

    // Brand
    public function setBrand(Brand $brand): void
    {
        $brand->attachProduct($this);
        $this->brand = $brand;
    }
    public function getBrand(): Brand
    {
        return $this->brand;
    }

    // Category
    public function setCategory(Category $category): void
    {
        $category->attachProduct($this);
        $this->category = $category;
    }
    public function getCategory(): Category
    {
        return $this->category;
    }

    // Gallery
    public function getImages(): Collection
    {
        return $this->galleries;
    }
    public function attachImage(Gallery $gallery): void
    {
        $this->galleries[] = $gallery;
    }

    // Prices
    public function getPrices(): Collection
    {
        return $this->prices;
    }
    public function addPrice(Price $price): void
    {
        $this->prices[] = $price;
    }

    // Attributes Sets
    public function getAttributeSets(): Collection
    {
        return $this->attributeSets;
    }
    public function assignToAttributeSet(AttributeSet $attributeSet): void
    {
        $this->attributeSets[] = $attributeSet;
    }
}
