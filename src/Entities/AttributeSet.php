<?php

namespace App\Entities;

use App\Repositories\AttributeSetRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: 'attribute_sets')]
#[ORM\HasLifecycleCallbacks]
class AttributeSet extends BaseEntity
{
    #[ORM\Column(type: 'string')]
    public string $name;

    #[ORM\Column(type: 'string')]
    public string $type;

    #[ORM\OneToMany(targetEntity: Attribute::class, mappedBy: 'attributeSet')]
    public Collection $attributes;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'attributeSets')]
    public Collection $products;

    public function __construct()
    {
        $this->attributes = new ArrayCollection;
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
    public function setType(string $type): void
    {
        $this->type = $type;
    }
    public function getType(): string
    {
        return $this->type;
    }

    // Attributes
    public function attachAttribute(Attribute $attribute)
    {
        $this->attributes[] = $attribute;
    }
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    // Products
    public function getProducts(): Collection
    {
        return $this->products;
    }
    public function addProduct(Product $product): void
    {
        $product->assignToAttributeSet($this);
        $this->products[] = $product;
    }
}
