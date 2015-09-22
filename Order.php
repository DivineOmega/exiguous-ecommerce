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
    
    public $id = null;
    public $data = null;
    
    public function __construct($id, $data)
    {
        $this->id = $id;
        $this->data = $data;
    }
}

?>