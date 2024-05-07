<?php

namespace App\Types;

use App\Types;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;

class OrderInputType extends InputObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'OrderInput',
            'fields' => [
                'productId' => new NonNull(Types::int()),
                'count' => new NonNull(Types::int()),
                'selectedAttributes' => new ListOfType(Types::attributeInput())
            ]
        ]);
    }
}
