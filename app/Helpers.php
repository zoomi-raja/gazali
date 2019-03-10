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
        $viewFile       = '';
        try {
            $path       = get_component();
            $viewFile   = 'App\Http\Components\\' . $path . '\Views\\';
        }catch (ReflectionException $exception) {
            // Output expected ReflectionException.
//            var_dump($exception);
        } catch (Exception $exception) {
            // Output unexpected Exceptions.
//            var_dump($exception);
        }
        return $viewFile;
    }
}

if (! function_exists('p')) {
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
if (! function_exists('get_component')) {
    function get_component()
    {
        /**
            *This array just to map paths which are not any resource custom binding
            *$var array;
        */
        $mapPaths = ['login' => 'auth', 'register' => 'auth' ];

        $pathArr    = explode('/', app()->make('request')->path());
        $components = ($pathArr[0] == 'api' )?$pathArr[1]:$pathArr[0];
        if(isset($mapPaths[$components]))
            return $mapPaths[$components];
        return $components;
    }
}

if (! function_exists('get_resource_path')) {
    function get_resource_path( $resourceName = null )
    {
        if(!$resourceName)
            return false;
        $path = asset("app/Http/Components/".ucfirst(get_component())."/Views/{$resourceName}/style.css");
        return $path;
    }
}

if(!function_exists('tokenizer')) {
    /**
     * @return mixed
     */
    function tokenizer()
    {
        return app()->make('JwtTokenizer');
    }
}