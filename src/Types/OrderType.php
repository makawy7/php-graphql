<?php

namespace App\Types;

use App\Types;
use GraphQL\Type\Definition\ObjectType;

class OrderType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'order_status' => Types::string(),
                'total_price' => Types::string(),
            ]
        ]);
    }
}
