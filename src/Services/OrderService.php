<?php

namespace App\Services;

use App\Entities\Attribute;
use App\Entities\Order;
use App\Entities\OrderContent;
use App\Entities\Product;

class OrderService
{
    public $entityManager;
    public array $orderItems;

    public function __construct($entityManager, array $orderItems)
    {
        $this->entityManager = $entityManager;
        $this->orderItems = $orderItems;
    }
    public function placeOrder(): Order
    {
        $orderTotal = 0;

        foreach ($this->orderItems as $orderItem) {
            $product = $this->entityManager->find(Product::class, $orderItem['productId']);
            $orderTotal = $orderTotal + (int) $orderItem['count'] * $product->prices[0]->amount;
        }

        $order = new Order();
        $order->setTotalPrice(number_format($orderTotal, 2, '.', ''));
        $order->setOrderStatus('Processing');
        $this->entityManager->persist($order);

        foreach ($this->orderItems as $orderItem) {
            $product = $this->entityManager->find(Product::class, $orderItem['productId']);
            $orderContent = new OrderContent();
            $orderContent->product = $product;
            $orderContent->assignToOrder($order);
            $orderContent->setQuantity($orderItem['count']);
            $this->entityManager->persist($orderContent);

            foreach ($orderItem['selectedAttributes'] as $attr) {
                $attribute = $this->entityManager->find(Attribute::class, $attr['itemId']);
                $orderContent->attachAttribute($attribute);
            }
        }

        $this->entityManager->flush();

        return $order;
    }
}
