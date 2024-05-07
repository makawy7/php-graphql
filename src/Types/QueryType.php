<?php

namespace App\Types;

use App\Entities\Category;
use App\Types;
use App\AppContext;
use App\Entities\Product;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\ObjectType;


class QueryType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Query',
            'fields' => [
                'products' => [
                    'type' => new ListOfType(Types::product()),
                    'args' => [
                        'category_name' => ['type' => Types::string()],
                    ],
                    'resolve' =>
                    static function ($rootValue, array $args, AppContext $context) {
                        $category = $context->entityManager->getRepository(Category::class)
                            ->findOneBy(['name' => $args['category_name']]);
                        return $args['category_name'] === 'all' ?
                            $context->entityManager->getRepository(Product::class)->findAll()
                            : $category->getProducts()->toArray();
                    }
                ],
                'product' => [
                    'type' => Types::product(),
                    'args' => ['slug' => ['type' => Types::string()]],
                    'resolve' => static function ($rootValue, array $args, AppContext $context) {
                        return $context->entityManager
                            ->getRepository(Product::class)->findOneBy([
                                'slug' => $args['slug']
                            ]);
                    }
                ],
                'categories' => [
                    'type' => new ListOfType(Types::category()),
                    'resolve' =>
                    static function ($rootValue, array $args, AppContext $context) {
                        return $context->entityManager
                            ->getRepository(Category::class)
                            ->findAll();
                    }
                ],
                'category' => [
                    'type' => Types::category(),
                    'args' => ['name' => ['type' => Types::string()]],
                    'resolve' =>
                    static function ($rootValue, array $args, AppContext $context) {
                        return $context->entityManager
                            ->getRepository(Category::class)
                            ->findOneBy(['name' => $args['name']]);
                    }

                ],
            ]
        ]);
    }
}
