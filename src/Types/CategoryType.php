<?php

namespace App\Types;

use App\Types;
use GraphQL\Type\Definition\ObjectType;

class CategoryType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'fields' => static fn (): array => [
                'id' => Types::id(),
                'name' => Types::string()
            ]
        ]);
    }
}
