<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'currencies')]
#[ORM\HasLifecycleCallbacks]
class Currency extends BaseEntity
{
    #[ORM\Column(type: 'string')]
    public string $label;

    #[ORM\Column(type: 'string')]
    public string $symbol;

    #[ORM\OneToMany(targetEntity: Price::class, mappedBy: 'currency')]
    public Collection $prices;

    public function __construct()
    {
        $this->prices = new ArrayCollection;
    }
    public function getLabel(): string
    {
        return $this->label;
    }
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }
    public function getSymbol(): string
    {
        return $this->symbol;
    }
    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }
    public function attachPrice(Price $price): void
    {
        $this->prices[] = $price;
    }
}
