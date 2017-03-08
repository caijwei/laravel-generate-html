<?php
namespace caijw\Generate;

use Illuminate\Support\ServiceProvider;

class GenerateServiceProvider extends ServiceProvider {
    protected $defer = false;
    public function boot(){
        include 'routes.php';/*路由*/
        $this->loadViewsFrom(__DIR__.'/views', 'generate');/*视图*/
        $this->publishes([//配置文件
            __DIR__.'/config/generate.php' => config_path('generate.php'),
        ]);
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

