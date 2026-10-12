<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Pagination memakai tampilan Tailwind buatan sendiri (resources/views/vendor/pagination/tivi.blade.php).
        Paginator::defaultView('vendor.pagination.tivi');

        // Daftar paket untuk pilihan di formulir pendaftaran (popup).
        View::composer('partials.install-modal', function ($view) {
            $view->with('packages', Product::orderBy('speed_mbps')->get(['id', 'name', 'speed_mbps', 'price']));
        });
    }
}
