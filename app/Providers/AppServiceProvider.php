<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        /**
         * @versioned('css/styles.css') — asset URL stamped with the file's mtime.
         *
         * Cloudflare caches css/js for 4 hours but not the HTML, so after a deploy
         * new markup was being served with the previous stylesheet. The stamp changes
         * whenever the file does, which makes every deploy a fresh URL and a cache miss.
         */
        Blade::directive('versioned', function ($expression) {
            return "<?php \$__asset = {$expression};
                echo e(asset(\$__asset) . '?v=' . (@filemtime(public_path(\$__asset)) ?: '1')); ?>";
        });
    }
}
