<?php
namespace caijw\Generate;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;

class GenerateServiceProvider extends ServiceProvider {
    protected $defer = false;
    public function boot(){



        $this->setupRoutes($this->app->router);//路由
        $this->loadViewsFrom(__DIR__.'/views', 'generate');//视图
        $this->publishes([//配置文件
            __DIR__.'/config/generate.php' => config_path('generate.php'),
        ]);
    }
    public function setupRoutes(Router $router){

        $router->group(['prefix' => Config::get('generate.refreshUrl', 'caijw_refresh'),'namespace' => 'caijw\Generate\Controllers'], function($router){
            include 'routes.php';/*路由*/

        });

    }
    public function register(){

    }
}

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void

    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'caijw\Generate\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }

    public function register()
    {
        $this->registerContact();
        config([
            'config/contact.php',
        ]);
    }
    private function registerContact()
    {
        $this->app->bind('contact',function($app){
            return new Contact($app);
        });
    }*/

