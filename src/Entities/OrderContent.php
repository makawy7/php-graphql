<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity]
#[ORM\Table(name: 'order_contents')]
#[ORM\HasLifecycleCallbacks]
class OrderContent extends BaseEntity
{
    #[ORM\Column(type: 'integer')]
    public int $quantity;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderContents')]
    public Order $order;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    public Product $product;

    #[ORM\ManyToMany(targetEntity: Attribute::class)]
    public Collection $attributes;

    public function __construct()
    {
        $this->attributes = new ArrayCollection;
    }
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
    public function assignToOrder(Order $order)
    {
        $order->addContent($this);
        $this->order = $order;
    }
    public function getOrder(): Order
    {
        return $this->order;
    }
    public function getProduct(): Product
    {
        return $this->product;
    }
    public function attachAttribute(Attribute $attribute): void
    {
        $this->attributes[] = $attribute;
    }
}
