<?php

namespace DivineOmega\ExiguousEcommerce;

class Basket
{
    public static function findCurrent()
    {
        $sessionStarted = @session_start();
        
        if (!$sessionStarted) {
            throw new \Exception("Unable to start session.");
        }
        
        if (!isset($_SESSION['ExiguousEcommerce'])) {
            $_SESSION['ExiguousEcommerce'] = new \stdClass();
        }
        
        if (!isset($_SESSION['ExiguousEcommerce']->Basket) || !is_object($_SESSION['ExiguousEcommerce']->Basket)) {
            $_SESSION['ExiguousEcommerce']->Basket = new Basket();
        }
        
        return $_SESSION['ExiguousEcommerce']->Basket;
    }
    
    public $items = array();
    
    public function __construct()
    {
        
    }
    
    public function addProduct($product, $quantity = 1)
    {
        foreach ($this->items as $item) {
            
            if ($item->product->id==$product->id) {
                
                $item->quantity += $quantity;
                $this->save();
                return;
            }
        }
        
        $this->items[] = new BasketItem($product, $quantity);
        $this->save();
    }
    
    private function save()
    {
        $sessionStarted = @session_start();
        
        if (!$sessionStarted) {
            throw new \Exception("Unable to start session.");
        }
        
        $_SESSION['ExiguousEcommerce']->Basket = $this;
    }
}

?>