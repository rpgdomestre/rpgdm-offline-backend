<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::directive('collectionTitle', function ($expression) {
            return "<?php echo Str::of($expression)->ltrim('_')->title() ?>";
        });
        Blade::directive('isCollectionHidden', function ($expression) {
            return "<?php echo $expression === true ? _('Yes') : _('No') ?>";
        });
    }
}
