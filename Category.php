<?php

namespace DivineOmega\ExiguousEcommerce;

class Category
{
    public static $directory = ".categories";
    public static $class = "Category";
    
    public static function find($id)
    {
        return ExiguousEcommerceItem::find(self::$directory, self::$class, $id);
    }
    
    public static function findBySlug($slug)
    {
        return ExiguousEcommerceItem::findBySlug(self::$directory, self::$class, $slug);
    }
    
    public $data = null;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function products()
    {
        $ids = isset($this->data->product_ids) && is_array($this->data->product_ids) ? $this->data->product_ids : array();
        
        $objs = [];
        
        foreach($ids as $id) {
            $objs[] = Product::find($id);
        }
        
        return $objs;
    }
}

?>