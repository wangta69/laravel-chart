<?php

namespace Pondol\Charts\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Pondol\Charts\Facades\RandomColor
 */
class RandomColor extends Facade
{

  protected static $cached = false;
  protected static function getFacadeAccessor()
  {
    return 'random-color-facade';
  }
}
