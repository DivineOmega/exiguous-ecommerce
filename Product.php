<?php

namespace DivineOmega\ExiguousEcommerce;

class Product
{
    public static $directory = '.products';
    public static $class = 'Product';

    public static function find($id)
    {
        return ExiguousEcommerceItem::find(self::$directory, self::$class, $id);
    }

    public static function findBySlug($slug)
    {
        return ExiguousEcommerceItem::findBySlug(self::$directory, self::$class, $slug);
    }

    public $id = null;
    public $data = null;

    public function __construct($id, $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function categories()
    {
        $ids = isset($this->data->category_ids) && is_array($this->data->category_ids) ? $this->data->category_ids : [];

        $objs = [];

        foreach ($ids as $id) {
            $obj = Category::find($id);

            if ($obj) {
                $objs[] = $obj;
            }
        }

        return $objs;
    }
}
