<?php

namespace App\Services;

use App\Services\ExchangeService;
use App\Facades\ApiDeMoedaFacade;



class UtilsService
{
  public function getLast()
  {
    $json = ApiDeMoedaFacade::get('/json/daily/USD-BRL/36')->json();
    return $json;
  }

  public function getCurrencyQuote(string $origin_currency, string $destination_currency)
  {
    
    $url = $origin_currency.'-'.$destination_currency;
    $key = $origin_currency.$destination_currency;
    
    $currency = ApiDeMoedaFacade::get("json/last/$url")->json();

    return $currency["$key"];
  } 

}