<?php

namespace DivineOmega\ExiguousEcommerce;

class Basket
{
    public static function findCurrent()
    {
        $sessionStarted = @session_start();

        if (!$sessionStarted) {
            throw new \Exception('Unable to start session.');
        }

        if (!isset($_SESSION['ExiguousEcommerce'])) {
            $_SESSION['ExiguousEcommerce'] = new \stdClass();
        }

        if (!isset($_SESSION['ExiguousEcommerce']->Basket) || !is_object($_SESSION['ExiguousEcommerce']->Basket)) {
            $_SESSION['ExiguousEcommerce']->Basket = new self();
        }

        return $_SESSION['ExiguousEcommerce']->Basket;
    }

    public $items = [];

    public function __construct()
    {
    }

    public function addProduct($product, $quantity = 1)
    {
        if (!$product || !is_object($product) || !isset($product->id)) {
            throw new \Exception('Unable to add an invalid product to the basket.');
        }

        if ($quantity <= 0) {
            throw new \Exception('Unable to add <= 0 quantity of a product to the basket.');
        }

        foreach ($this->items as $item) {
            if ($item->product->id == $product->id) {
                $item->quantity += $quantity;
                $this->save();

                return;
            }
        }

        $this->items[] = new BasketItem($product, $quantity);
        $this->save();
    }

    public function removeProduct($product)
    {
        if (!$product || !is_object($product) || !isset($product->id)) {
            throw new \Exception('Unable to add an invalid product to the basket.');
        }

        foreach ($this->items as $key => $item) {
            if ($item->product->id == $product->id) {
                unset($this->items[$key]);

                $this->save();

                return;
            }
        }
    }

    public function offsetProductQuantity($product, $quantityOffset)
    {
        if (!$product || !is_object($product) || !isset($product->id)) {
            throw new \Exception('Unable to add an invalid product to the basket.');
        }

        foreach ($this->items as $item) {
            if ($item->product->id == $product->id) {
                if ($item->quantity + $quantityOffset < 0) {
                    throw new \Exception('Unable to offset quantity of a product to the basket to below zero.');
                }

                $item->quantity += $quantityOffset;
                $this->save();

                return;
            }
        }
    }

    private function save()
    {
        $sessionStarted = @session_start();

        if (!$sessionStarted) {
            throw new \Exception('Unable to start session.');
        }

        $_SESSION['ExiguousEcommerce']->Basket = $this;
    }
}
