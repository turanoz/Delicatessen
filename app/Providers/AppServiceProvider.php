<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        //
        Schema::defaultStringLength(191);

        Paginator::useBootstrap();
        View::composer("*", function (\Illuminate\View\View $view) {
            $__products = Product::where("satilanmiktar","!=","0")->orderBy("satilanmiktar", "DESC")->limit(3)->get();
            $view->with("__products", $__products);
        });
        View::composer("*", function (\Illuminate\View\View $view) {
            $__productsimage = Product::inRandomOrder()->limit(9)->get();
            $view->with("__productsimage", $__productsimage);
        });
        View::composer("*", function (\Illuminate\View\View $view) {
            $_site = Admin::first();
            $view->with("_site", json_decode($_site->json));
        });
        View::composer("frontend.pages.shop", function (\Illuminate\View\View $view) {
            $__categories = Category::get();

            $view->with("__categories", $__categories);
        });

    }
}
