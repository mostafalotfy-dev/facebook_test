<?php

namespace App\Providers;

use Facebook\Facebook;
use Illuminate\Support\ServiceProvider;

class FacebookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Facebook::class,function($app){
            return new \Facebook\Facebook([
                'app_id' => env("FACEBOOK_APP_ID"),
                'app_secret' => env("FACEBOOK_APP_SECRET"),
                'default_graph_version' => 'v13.0',
                //'default_access_token' => '{access-token}', // optional
              ]);
        });
        
    }
}
