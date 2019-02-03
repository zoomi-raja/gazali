<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 2/3/2019
 * Time: 10:47 AM
 */
if (! function_exists('get_component_resource')) {
    /**
     * Get the path to the resources folder.
     *
     * @param  string  $path
     * @return string
     */
    function get_component_resource($path = '')
    {
        $path       = app()->make('request')->path();
        $viewFile   = 'App\Http\Components\\'.$path.'\views\\';
        return $viewFile;
    }
}

if (! function_exists('get_component_resource')) {
    function p($printData, $haltExec = false)
    {
        if (is_array($printData) || is_object($printData)) {
            echo '<pre>';
            print_r($printData);
            echo '</pre>';
        } else {
            echo $printData;
        }

        if ($haltExec) {
            die();
        }
    }
}