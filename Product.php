<?php

namespace DivineOmega\ExiguousEcommerce;

class Product
{
    public static $directory = ".products";
    
    public static function find($id)
    {
        $file = __DIR__."/".self::$directory."/".$id.".json";
        
        if (!file_exists($file)) {
            throw new \Exception("File does not exist: ".$file);
        }
        
        if (!$data = json_decode(file_get_contents($file))) {
            throw new \Exception("Error exists in file (".json_last_error_msg()."): ".$file);
        }
        
        return new self($data);
    }
    
    public static function findBySlug($slug)
    {
        for ($id = 1; $id < PHP_INT_MAX; $id++) {
            
            $file = __DIR__."/".self::$directory."/".$id.".json";
        
            if (!file_exists($file)) {
                break;
            }
            
            $obj = self::find($id);
            
            if ($obj->data->slug==$slug) {
                return $obj;
            }
        }
        
        throw new \Exception("No item found with specified slug.");
    }
    
    public $data = null;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function categories()
    {
        $ids = isset($this->data->category_ids) && is_array($this->data->category_ids) ? $this->data->category_ids : array();
        
        $objs = [];
        
        foreach($ids as $id) {
            $objs[] = Category::find($id);
        }
        
        return $objs;
    }
}

?>