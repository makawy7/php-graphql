<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'galleries')]
#[ORM\HasLifecycleCallbacks]
class Gallery extends BaseEntity
{
    #[ORM\Column(type: 'string')]
    public string $imageURL;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'galleries')]
    public Product $product;

    public function getImageURL(): string
    {
        return $this->imageURL;
    }
    public function setImageURL(string $imageURL): void
    {
        $this->imageURL = $imageURL;
    }
    public function assignToProduct(Product $product): void
    {
        $product->attachImage($this);
        $this->product = $product;
    }
    public function getProduct(): Product
    {
        return $this->product;
    }
}
