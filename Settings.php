<?php

namespace DivineOmega\ExiguousEcommerce;

class Settings
{
    public static $directory = '.settings';
    
    public static function find($name)
    {
        $file = __DIR__.'/'.self::$directory.'/'.$name.'.json';
        
        if (!file_exists($file)) {
            throw new \Exception('File does not exist: '.$file);
        }

        if (!$data = json_decode(file_get_contents($file))) {
            throw new \Exception('Error exists in file ('.json_last_error_msg().'): '.$file);
        }
        
        return new self($name, $data);
    }
    
    public $name;
    public $data;
    
    public function __construct($name, $data)
    {
        $this->name = $name;
        $this->data = $data;
    }
}

?>