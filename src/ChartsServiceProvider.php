<?php

namespace Pondol\Charts;


use Illuminate\Support\ServiceProvider;

use Pondol\Charts\Console\Commands\InstallCommand;

use Pondol\Charts\Builder\ChartJs;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Route;

class ChartsServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register()
  {


    if ($this->app->runningInConsole()) {
      
    }

    $this->app->singleton('chartjs-facade', function () {
      return new ChartJs();
    });
  }

  /**
   * Bootstrap services.
   */
  public function boot()
  {
    // Register config
    // $this->publishes([
    //   __DIR__ . '/config/visitorstatistics.php' => config_path('visitorstatistics.php'),
    // ], 'config');
    // $this->mergeConfigFrom(
    //   __DIR__ . '/config/visitorstatistics.php',
    //   'visitorstatistics'
    // );

    // // Register routes
    // $this->mapStatisticsRoutes();

    // // Register migrations
    // $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

    // Register commands and set task scheduling
    $this->commands([
      InstallCommand::class
    ]);

    $this->loadViewsFrom(__DIR__.'/resources/views', 'chart');
    
    // $this->app->booted(function () {
    //     // Since maxmind database is updated every first Thursday of the month
    //     // day 12 of each month is guaranteed to be on or after first Thursday
    //     $schedule = app(Schedule::class);
    //     $schedule->command(UpdateMaxMindDatabase::class, ['scheduled' => true])->monthlyOn(12, '00:00');
    // });

    // // Register middleware and add it to 'web' group
    // app('router')->pushMiddlewareToGroup('web', RecordVisits::class);
  }
  /**
   * Define routes for getting statistics data.
   *
   * @return void
   */
  private function mapStatisticsRoutes()
  {
    // $config = config('visitorstatistics');

    // Route::prefix($config['prefix'])
    //   ->middleware($config['middleware'])
    //   ->namespace('Pondol\VisitorsStatistics\Http\Controllers')
    //   ->group(__DIR__ . '/routes/web.php');
  }

}
