<?php

namespace Saphir\Multi;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;

class SaphirServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
       $this->mergeConfigFrom(
            __DIR__.'/../config/saphir.php', 'saphir'
        );
    }

   
    public function boot(): void
    {
     $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views','saphir');

        $this->publishes([
            __DIR__.'/../config/saphir.php' => config_path('saphir.php'),
        ], 'config');

        $this->commands([
            \Saphir\Multi\Commands\SaphirCommand::class,
            \Saphir\Multi\Commands\PanelCommand::class,
            \Saphir\Multi\Commands\CreateUser::class,
        ]);
   

        Livewire::component('saphir1', \Saphir\Multi\Livewire\Saphir1::class);
        Livewire::component('saphir2', \Saphir\Multi\Livewire\Saphir2::class);
        Livewire::component('saphir3', \Saphir\Multi\Livewire\Saphir3::class);
        Livewire::component('saphir4', \Saphir\Multi\Livewire\Saphir4::class);
        Livewire::component('saphir5', \Saphir\Multi\Livewire\Saphir5::class);
        Livewire::component('saphir6', \Saphir\Multi\Livewire\Saphir6::class);
        Livewire::component('saphir7', \Saphir\Multi\Livewire\Saphir7::class);
        Livewire::component('saphir8', \Saphir\Multi\Livewire\Saphir8::class);
        Livewire::component('saphir.sidebar', \Saphir\Multi\Livewire\Sidebar::class);
        Livewire::component('saphir.sidebar2', \Saphir\Multi\Livewire\Sidebar2::class);
        Livewire::component('saphir.navbar', \Saphir\Multi\Livewire\Navbar::class);
        Livewire::component('saphir.navbar2', \Saphir\Multi\Livewire\Navbar2::class);
        Livewire::component('saphir.chartexample', \Saphir\Multi\Livewire\Chartexample::class);
        Livewire::component('saphir.chartexample2', \Saphir\Multi\Livewire\Chartexample2::class);
        Livewire::component('saphir.chartexample3', \Saphir\Multi\Livewire\Chartexample3::class);
        Livewire::component('saphir.widget', \Saphir\Multi\Livewire\Widget::class);
        Livewire::component('saphir.saphircreator', \Saphir\Multi\Livewire\SaphirCreator::class);
        Livewire::component('saphir.saphirupdate', \Saphir\Multi\Livewire\SaphirUpdate::class);
        Livewire::component('saphir.wizardcreator', \Saphir\Multi\Livewire\WizardCreator::class);
        Livewire::component('saphir.wizardupdate', \Saphir\Multi\Livewire\WizardUpdate::class);
        Livewire::component('saphir.listing', \Saphir\Multi\Livewire\Listing::class);

        Blade::component('saphir::components.saphirModal', 'saphir-modal');
        Blade::component('saphir::components.saphirAllButtons', 'saphir-all-btn');
    }
}
