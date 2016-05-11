<?php

namespace DivineOmega\ExiguousEcommerce;

class Category
{
    public static $directory = '.categories';
    public static $class = 'Category';

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

    public function products()
    {
        $ids = isset($this->data->productIds) && is_array($this->data->productIds) ? $this->data->productIds : [];

        $objs = [];

        foreach ($ids as $id) {
            $obj = Product::find($id);

            if ($obj) {
                $objs[] = $obj;
            }
        }

        return $objs;
    }

    public function save()
    {
        ExiguousEcommerceItem::save(self::$directory, $this);
    }
}
