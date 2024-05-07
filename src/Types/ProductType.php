<?php

namespace App\Types;

use App\Entities\Product;
use App\Types;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\ObjectType;

class ProductType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => static fn (): array => [
                'id' => Types::id(),
                'name' => Types::string(),
                'slug' => Types::string(),
                'description' => Types::string(),
                'inStock' => Types::boolean(),
                'gallery' => [
                    'type' => new ListOfType(Types::string()),
                    'resolve' => static function (Product $product) {
                        return array_map(fn ($gallery) => $gallery['imageURL'], $product->getImages()->toArray());
                    }
                ],
                'attributes' => [
                    'type' => new ListOfType(Types::attributeSet()),
                    'resolve' => static function (Product $product) {
                        return $product->getAttributeSets()->toArray();
                    }
                ],
                'prices' => [
                    'type' => new ListOfType(Types::price()),
                    'resolve' => static function (Product $product) {
                        return $product->getPrices()->toArray();
                    }
                ],
            ]
        ]);
    }
}
