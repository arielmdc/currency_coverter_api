<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ApiDeMoedaFacade extends Facade
{
  protected static function getFacadeAccessor()
  {
    return 'api-de-moeda';
  }
}