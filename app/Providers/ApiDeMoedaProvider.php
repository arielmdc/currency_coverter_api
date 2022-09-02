<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class ApiDeMoedaProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
      $this->app->bind('api-de-moeda', function(){
        return Http::withOptions([
          'verify' => false,
          'base_uri'=>'https://economia.awesomeapi.com.br'
        ]);
      });
  }
}