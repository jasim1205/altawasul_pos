<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use NumberFormatter;


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
        Paginator::useBootstrap();
        Blade::directive('numberToWords', function ($expression) {
        return "<?php echo ucwords(strtolower(NumberFormatter::create('en', NumberFormatter::SPELLOUT)->format($expression))); ?>";
    });
    }
}
