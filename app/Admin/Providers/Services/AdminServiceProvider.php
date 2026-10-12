<?php

namespace App\Providers\Admin\Services;

use App\Admin\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }
        
    public function boot(): void
    {
        Route::prefix('admin')
            ->middleware(AdminMiddleware::class)
            ->group(base_path('routes/admin.php'));
    }
}
