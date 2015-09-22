<?php

namespace DivineOmega\ExiguousEcommerce;

class ExiguousEcommerceItem
{
    public static function find($directory, $class, $id)
    {
        $class = __NAMESPACE__."\\".$class;
        
        $file = __DIR__."/".$directory."/".$id.".json";
        
        if (!file_exists($file)) {
            throw new \Exception("File does not exist: ".$file);
        }
        
        if (!$data = json_decode(file_get_contents($file))) {
            throw new \Exception("Error exists in file (".json_last_error_msg()."): ".$file);
        }
        
        if (isset($data->deleted_at) && $data->deleted_at>0) {
            throw new \Exception("File data is marked as deleted: ".$file);
        }
        
        return new $class($data);
    }
    
    public $data = null;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
}

?>