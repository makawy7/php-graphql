<?php

namespace App\Types;

use App\Types;
use GraphQL\Type\Definition\ObjectType;

class AttributeType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Attribute',
            'fields' => static fn () => [
                'id' => Types::id(),
                'name' => Types::string(),
                'displayValue' => Types::string(),
                'value' => Types::string(),
            ]
        ]);
    }
}
