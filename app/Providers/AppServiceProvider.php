<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\WebsitePage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
 Paginator::useBootstrap();
        view()->composer('*', function ($view) {
            $categoriesMenu = Category::with('subcategories')
                ->where('status', 1)
                ->whereNotIn('id', [12, 13, 16])
                ->get();
            // FOOTER CATEGORIES
            $footerCategories = Category::where('status', 1)->get();
            $websitePage = WebsitePage::where('status', 1)->get();
            // SHARE TO ALL VIEWS

           
            $view->with([
                'categoriesMenu' => $categoriesMenu,
                'footerCategories' => $footerCategories,
                'websitePage' => $websitePage
            ]);
        });
    }
}
