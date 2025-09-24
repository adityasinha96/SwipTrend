<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\Facades\Schema; 
use App\Models\CompanyDetail;

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
    public function boot(): void
    {
        // Only try to query after the table exists (avoids errors during 'php artisan migrate:fresh', etc.)
        if (Schema::hasTable('company_details')) {
            View::composer('*', function ($view) {
                $company = CompanyDetail::first();
                $view->with('companyDetail', $company);
            });
        }
    }
}
