<?php

namespace BhaktijKoli\LaravelDialogflow\Facades;

use Illuminate\Support\Facades\Facade;

class Fulfillment extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  {
      return 'Fulfillment';
  }
}
