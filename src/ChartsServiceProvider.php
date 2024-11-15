<?php

namespace Pondol\Charts;


use Illuminate\Support\ServiceProvider;

use Pondol\Charts\Console\Commands\InstallCommand;

use Pondol\Charts\Builder\ChartJs;
use Pondol\Charts\Services\RandomColor;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Route;

class ChartsServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register()
  {

    $this->app->bind('chartjs-facade', function () {
      return new ChartJs();
    });

    $this->app->singleton('random-color-facade', function () {
      return new RandomColor();
    });
  }

  /**
   * Bootstrap services.
   */
  public function boot()
  {

    // Register commands and set task scheduling
    $this->commands([
      InstallCommand::class
    ]);

    $this->loadViewsFrom(__DIR__.'/resources/views', 'chart');
  }
}
