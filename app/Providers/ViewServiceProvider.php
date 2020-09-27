<?php declare(strict_types=1);

namespace App\Providers;

use App\View\Composers\SectionsComposer;
use App\View\Composers\WeeklyNumberComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('livewire.save-link', SectionsComposer::class);
        View::composer('livewire.update-link', SectionsComposer::class);
        View::composer('links.create', WeeklyNumberComposer::class);
    }
}
