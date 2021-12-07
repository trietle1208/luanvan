<?php

namespace App\Providers;

use App\Models\OrderDetail;
use App\Models\OrderNCC;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use App\Observers\OrderDetailObserver;
use App\Observers\OrderNccObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        OrderDetail::observe(OrderDetailObserver::class);
        OrderNCC::observe(OrderNccObserver::class);
    }
}
