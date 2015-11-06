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

    public function unitCost($currency)
    {
        $unitCost = null;
        
        if (isset($item->product)) {
            
            // TODO: Retrieve current unit cost based on $this->product->data->priceRules
            
            foreach ($this->product->data->prices as $price) {
                if ($price->currency == $currency) {
                    $unitCost = $price->value;
                    break;
                }
            }
        }
        
        return $unitCost;
    }

    public function lineTotal($currency)
    {
        return $this->unitCost($currency) * $this->quantity;
    }
}
