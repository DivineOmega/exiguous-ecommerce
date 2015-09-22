<?php

namespace DivineOmega\ExiguousEcommerce;

class Order
{
    public static $directory = ".orders";
    
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
    
    public $data = null;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
}

?>