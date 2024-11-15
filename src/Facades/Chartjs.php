<?php

namespace Pondol\Charts\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Pondol\Charts\Builder\Chartjs 
 */
class Chartjs extends Facade
{

  protected static $cached = false;
  protected static function getFacadeAccessor()
  {
    return 'chartjs-facade';
  }

  public static function refresh()
  {
    static::clearResolvedInstance(static::getFacadeAccessor());

    return static::getFacadeRoot();
  }
}
