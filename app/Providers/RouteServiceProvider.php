<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Components';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        if (strpos(php_sapi_name(), 'cli') !== false) {
            $components = array_filter(glob($this->namespace.'/*'), 'is_dir');
            foreach( $components as $component ){
                if(file_exists($component.'/Routes\web.php')){
                    $routeFiles[] = $component.'/Routes\web.php';
                }
            }
        }else{
            $path           = get_component();
            $routeFile      = $this->namespace.'\\'.$path.'\Routes\web.php';
            $routeFiles[]   = file_exists($routeFile)?$routeFile:'routes/web.php';
        }
        $routeGenerator = Route::middleware('web')
             ->namespace($this->namespace);
        foreach ($routeFiles as $route){
            $routeGenerator->group(base_path($route));
        }
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        if (strpos(php_sapi_name(), 'cli') !== false) {
            $components = array_filter(glob($this->namespace.'/*'), 'is_dir');
            foreach( $components as $component ){
                if(file_exists($component.'/Routes\api.php')){
                    $routeFiles[] = $component.'/Routes\api.php';
                }
            }
        }else{
            $path           = get_component();
            $routeFile      = $this->namespace.'\\'.$path.'\Routes\api.php';
            $routeFiles[]   = file_exists($routeFile)?$routeFile:'routes/api.php';
        }
        $routeGenerator = Route::middleware('api')
            ->namespace($this->namespace);
        foreach ($routeFiles as $route){
            $routeGenerator->group(base_path($route));
        }
    }
}
