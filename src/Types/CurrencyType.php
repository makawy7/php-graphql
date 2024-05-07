<?php

namespace App\Types;

use App\Types;
use GraphQL\Type\Definition\ObjectType;

class CurrencyType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => [
                'label' => Types::string(),
                'symbol' => Types::string(),
            ]
        ]);
    }
}
