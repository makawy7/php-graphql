<?php

namespace App\Types;

use App\Services\OrderService;
use App\Types;
use App\AppContext;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\ObjectType;


class MutationType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Mutation',
            'fields' => [
                'createOrder' => [
                    'type' => Types::order(),
                    'args' => ['order' => new NonNull(new ListOfType(Types::orderInput()))],
                    'resolve' => static function ($rootValue, array $args, AppContext $context) {
                        $orderService = new OrderService($context->entityManager, $args['order']);
                        return $orderService->placeOrder();
                    },
                ]
            ]
        ]);
    }
}
