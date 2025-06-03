<?php

namespace App\Providers;

use App\Models\Consultation;
use App\Observers\ConsultationObserver;
use Illuminate\Support\ServiceProvider;

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
        Consultation::observe(ConsultationObserver::class);
    }
}
