<?php

namespace App;

use App\Types\AttributeInputType;
use App\Types\AttributeSetType;
use App\Types\AttributeType;
use App\Types\PriceType;
use App\Types\ProductType;
use App\Types\CategoryType;
use App\Types\CurrencyType;
use App\Types\OrderInputType;
use App\Types\OrderType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ScalarType;

class Types
{
    private static array $types = [];

    public static function load(string $typeName): Type
    {
        if (isset(self::$types[$typeName])) {
            return self::$types[$typeName];
        }

        switch ($typeName) {
            case 'ID':
                $methodName = 'id';
                break;
            default:
                $methodName = \lcfirst($typeName);
        }
        if (!method_exists(self::class, $methodName)) {
            throw new \Exception("Unknown GraphQL type: {$typeName}.");
        }

        $type = self::{$methodName}();
        if (is_callable($type)) {
            $type = $type();
        }

        return self::$types[$typeName] = $type;
    }
    private static function byClassName(string $className): Type
    {
        $classNameParts = explode('\\', $className);
        $baseClassName = end($classNameParts);

        $typeName = preg_replace('~Type$~', '', $baseClassName);

        return self::$types[$typeName] ??= new $className;
    }

    private static function lazyByClassName(string $className): \Closure
    {
        return static fn () => self::byClassName($className);
    }

    public static function boolean(): ScalarType
    {
        return Type::boolean();
    }
    public static function float(): ScalarType
    {
        return Type::float();
    }
    public static function id(): ScalarType
    {
        return Type::id();
    }
    public static function int(): ScalarType
    {
        return Type::int();
    }
    public static function string(): ScalarType
    {
        return Type::string();
    }
    public static function product(): callable
    {
        return self::lazyByClassName(ProductType::class);
    }
    public static function category(): callable
    {
        return self::lazyByClassName(CategoryType::class);
    }
    public static function attributeSet(): callable
    {
        return self::lazyByClassName(AttributeSetType::class);
    }
    public static function attribute(): callable
    {
        return self::lazyByClassName(AttributeType::class);
    }
    public static function price(): callable
    {
        return self::lazyByClassName(PriceType::class);
    }
    public static function currency(): callable
    {
        return self::lazyByClassName(CurrencyType::class);
    }
    public static function orderInput(): callable
    {
        return self::lazyByClassName(OrderInputType::class);
    }
    public static function attributeInput(): callable
    {
        return self::lazyByClassName(AttributeInputType::class);
    }
    public static function order(): callable
    {
        return self::lazyByClassName(OrderType::class);
    }
}
