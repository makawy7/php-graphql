<?php

namespace App\Types;

use App\Entities\Price;
use App\Types;
use GraphQL\Type\Definition\ObjectType;

class PriceType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'amount' => Types::float(),
                'currency' => [
                    'type' => Types::currency(),
                    'resolve' => static function (Price $price) {
                        return $price->getCurrency();
                    },
                ],
            ]
        ]);
    }
}
