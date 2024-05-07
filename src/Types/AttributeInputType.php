<?php

namespace App\Types;

use App\Types;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\NonNull;

class AttributeInputType extends InputObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'AttributeInput',
            'fields' => [
                'attrId' => Types::int(),
                'itemId' => Types::int()
            ]
        ]);
    }
}
