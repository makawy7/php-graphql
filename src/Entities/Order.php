<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'orders')]
#[ORM\HasLifecycleCallbacks]
class Order extends BaseEntity
{
    #[ORM\Column(type: 'string')]
    public string $orderStatus = 'processing';

    #[ORM\Column(type: 'float')]
    public float $totalPrice;

    #[ORM\OneToMany(targetEntity: OrderContent::class, mappedBy: 'order')]
    public Collection $orderContents;

    public function __construct()
    {
        $this->orderContents = new ArrayCollection;
    }
    public function getOrderStatus(): string
    {
        return $this->orderStatus;
    }
    public function setOrderStatus(string $orderStatus): void
    {
        $this->orderStatus = $orderStatus;
    }
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }
    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }
    public function addContent(OrderContent $orderContent): void
    {
        $this->orderContents[] = $orderContent;
    }
}
