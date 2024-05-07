<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'prices')]
#[ORM\HasLifecycleCallbacks]
class Price extends BaseEntity
{
    #[ORM\Column(type: 'float')]
    public float $amount;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'prices')]
    public Product $product;

    #[ORM\ManyToOne(targetEntity: Currency::class, inversedBy: 'prices')]
    public Currency $currency;

    public function getAmount(): string
    {
        return number_format((float)$this->amount, 2, '.', '');
    }
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    // Currency
    public function setCurrency(Currency $currency)
    {
        $currency->attachPrice($this);
        $this->currency = $currency;
    }
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    // Product
    public function getProduct(): Product
    {
        return $this->product;
    }
    public function setProduct(Product $product): void
    {
        $product->addPrice($this);
        $this->product = $product;
    }
}
