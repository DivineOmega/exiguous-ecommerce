<?php

namespace DivineOmega\ExiguousEcommerce;

class Order
{
    public static $directory = ".orders";
    public static $class = "Order";
    
    public static function find()
    {
        return ExiguousEcommerceItem::find(self::$directory, self::$class, $id);
    }
    
    public $data = null;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
}

?>