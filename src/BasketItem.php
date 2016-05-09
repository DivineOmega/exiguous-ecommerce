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

        if (isset($this->product)) {

          // Check product price rules for a price.
          if (isset($this->product->data->priceRules) && is_array($this->product->data->priceRules)) {
              foreach ($this->product->data->priceRules as $priceRule) {
                  if ($priceRule->currency != $currency) {
                      continue;
                  }
                  if ($this->quantity > $priceRule->greaterThanXUnits) {
                      $unitCost = $priceRule->value;
                  }
              }
          }

          // If we've not got a unit cost from checking the price rules, then
          // just get the regular product price.
          if (!$unitCost) {
              foreach ($this->product->data->prices as $price) {
                  if ($price->currency != $currency) {
                      continue;
                  }
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
