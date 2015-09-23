<?php

namespace DivineOmega\ExiguousEcommerce;

class BasketItem
{
    public $product;
    public $quantity;

    public function __construct($product, $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
}
