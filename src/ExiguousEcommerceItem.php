<?php

namespace DivineOmega\ExiguousEcommerce;

class ExiguousEcommerceItem
{
    public static function find($directory, $class, $id)
    {
        $class = __NAMESPACE__.'\\'.$class;

        $file = __DIR__.'/../data/'.$directory.'/'.$id.'.json';

        if (!file_exists($file)) {
            throw new \Exception('File does not exist: '.$file);
        }

        if (!$data = json_decode(file_get_contents($file))) {
            throw new \Exception('Error exists in file ('.json_last_error_msg().'): '.$file);
        }

        if (isset($data->deleted_at) && $data->deleted_at > 0) {
            return;
        }

        if (isset($data->draft) && $data->draft == true) {
            return;
        }

        return new $class($id, $data);
    }

    public static function findBySlug($directory, $class, $slug)
    {
        for ($id = 1; $id < PHP_INT_MAX; $id++) {
            $file = __DIR__.'/../data/'.$directory.'/'.$id.'.json';

            if (!file_exists($file)) {
                break;
            }

            $obj = self::find($directory, $class, $id);

            if (isset($obj->data->slug) && $obj->data->slug == $slug) {
                return $obj;
            }
        }

        throw new \Exception('No item found with specified slug.');
    }

    public static function getUsusedId($directory)
    {
        for ($id = 1; $id < PHP_INT_MAX; $id++) {
            $file = __DIR__.'/../data/'.$directory.'/'.$id.'.json';

            if (!file_exists($file)) {
                return $id;
            }
        }

        return false;
    }

    public static function save($directory, $object)
    {
        $file = __DIR__.'/../data/'.$directory.'/'.$object->id.'.json';

        $data = json_encode($object->data, JSON_PRETTY_PRINT);

        file_put_contents($file, $data);
    }
}
