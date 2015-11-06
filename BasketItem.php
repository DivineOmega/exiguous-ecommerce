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
    
    public function unitCost()
    {
        // TODO: Retrieve current unit cost based on priceRules
        return 0.00;
    }
    
    public function lineTotal()
    {
        return $this->unitCost() * $this->quantity;
    }
}
