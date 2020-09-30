<?php

namespace App\Providers;

use App\setting;
use App\category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\favorite_item;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */  
    public function boot()
    {
            View::composer('front.include.master', function ($view) {
            $view->with('appsetting'  , setting::first());
            $view->with('wishlistcount'  , Auth()->user() ? favorite_item::where('user_id',Auth()->user()->id)->count() : 0);
            $view->with('footercats'  , category::all());
        });
    }
}
