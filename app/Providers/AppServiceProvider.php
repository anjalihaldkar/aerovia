<?php

namespace App\Providers;

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
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                \Illuminate\Support\Facades\View::share('settings', \App\Models\Setting::first());
            } else {
                \Illuminate\Support\Facades\View::share('settings', null);
            }

            if (\Illuminate\Support\Facades\Schema::hasTable('faqs')) {
                \Illuminate\Support\Facades\View::share('faqs', \App\Models\Faq::all());
            } else {
                \Illuminate\Support\Facades\View::share('faqs', collect());
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\View::share('settings', null);
            \Illuminate\Support\Facades\View::share('faqs', collect());
        }
    }
}
