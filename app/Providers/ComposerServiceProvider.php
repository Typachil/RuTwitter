<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class ComposerServiceProvider extends ServiceProvider
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
        View::composer('layout', function($view) {
            $view->with(['authUser' => Auth::check()]);
        });

        View::composer('private', function($view){
            $posts = new Post();
            $view->with(['user_posts' => $posts->all()->where('user_id', Auth::user()->id)]);
        });
    }
}
