<?php

namespace App\Types;

use App\Entities\AttributeSet;
use App\Types;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\ObjectType;

class AttributeSetType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'AttributeSet',
            'fields' => static fn () => [
                'id' => Types::id(),
                'name' => Types::string(),
                'type' => Types::string(),
                'items' => [
                    'type' => new ListOfType(Types::attribute()),
                    'resolve' => static function (AttributeSet $attributeSet) {
                        return $attributeSet->getAttributes()->toArray();
                    }
                ],
            ]
        ]);
    }
}
