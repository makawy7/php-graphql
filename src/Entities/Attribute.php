<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'attributes')]
#[ORM\HasLifecycleCallbacks]
class Attribute extends BaseEntity
{
    #[ORM\Column(type: 'string')]
    public string $name;

    #[ORM\Column(type: 'string')]
    public string $displayValue;

    #[ORM\Column(type: 'string')]
    public string $value;

    #[ORM\ManyToOne(targetEntity: AttributeSet::class, inversedBy: 'attributes')]
    public AttributeSet $attributeSet;

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getDisplayValue(): string
    {
        return $this->displayValue;
    }
    public function setDisplayValue(string $displayValue): void
    {
        $this->displayValue = $displayValue;
    }
    public function getValue(): string
    {
        return $this->value;
    }
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
    public function assignToAttributeSet(AttributeSet $attributeSet): void
    {
        $attributeSet->attachAttribute($this);
        $this->attributeSet = $attributeSet;
    }
    public function getAttributeSet(): AttributeSet
    {
        return $this->attributeSet;
    }
}
