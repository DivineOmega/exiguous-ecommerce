<?php

namespace DivineOmega\ExiguousEcommerce;

abstract class ExiguousEcommerceItem
{
    private static $includeDrafts = false;

    public static function includeDrafts($includeDrafts)
    {
        self::$includeDrafts = $includeDrafts;
    }

    public static function find($directory, $class, $id)
    {
        $class = __NAMESPACE__.'\\'.$class;

        $file = ExiguousEcommerceConfig::getDataDirectory().$directory.'/'.$id.'.json';

        if (!file_exists($file)) {
            throw new \Exception('The data file for the specified ID does not exist: '.$file);
        }

        if (!$data = json_decode(file_get_contents($file))) {
            throw new \Exception('Error(s) exist in the data file for the specified ID ('.json_last_error_msg().'): '.$file);
        }

        if (isset($data->deletedAt) && $data->deletedAt > 0) {
            return;
        }

        if (!self::$includeDrafts) {
            if (isset($data->draft) && $data->draft == true) {
                return;
            }
        }

        return new $class($id, $data);
    }

    private static function getStartingID($directory) {

        $coreSettings = Settings::find('core');

        $startingID = 1;

        if (isset($coreSettings->data->startingIDs)) {
            if (isset($coreSettings->data->startingIDs->$directory) && is_numeric($coreSettings->data->startingIDs->$directory)) {
                $startingID = $coreSettings->data->startingIDs->$directory;
            }
        }

        return $startingID;

    }

    public static function all($directory, $class)
    {
        $objs = [];

        for ($id = self::getStartingID($directory); $id < PHP_INT_MAX; $id++) {
            $file = ExiguousEcommerceConfig::getDataDirectory().$directory.'/'.$id.'.json';

            if (!file_exists($file)) {
                break;
            }

            $obj = self::find($directory, $class, $id);

            if ($obj) {
                $objs[] = $obj;
            }
        }

        return $objs;
    }

    public static function findBySlug($directory, $class, $slug)
    {
        for ($id = self::getStartingID($directory); $id < PHP_INT_MAX; $id++) {
            $file = ExiguousEcommerceConfig::getDataDirectory().$directory.'/'.$id.'.json';

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
        for ($id = self::getStartingID($directory); $id < PHP_INT_MAX; $id++) {
            $file = ExiguousEcommerceConfig::getDataDirectory().$directory.'/'.$id.'.json';

            if (!file_exists($file)) {
                return $id;
            }
        }

        return false;
    }

    public static function save($directory, $object)
    {
        $file = ExiguousEcommerceConfig::getDataDirectory().$directory.'/'.$object->id.'.json';

        $data = json_encode($object->data, JSON_PRETTY_PRINT);

        file_put_contents($file, $data);
    }
}
