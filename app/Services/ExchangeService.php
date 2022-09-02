<?php

namespace App\Services;

use App\Models\ConvertionFee;
use App\Models\PaymentMethod;

class ExchangeService
{

  public function applyFees(array $request_data, $quote) : array
    {
      // var_dump($quote);
      // exit;
      $exchange = [
          'origin_currency'            => $quote['code'],
          'destination_currency'       => $quote['codein'],
          'value'                      => $request_data['value'],
          'payment_method'             => $request_data['payment_method'],
          'destination_currency_price' => $quote['ask'],
      ];

      $exchange['payment_method_fee'] = $this->applyPaymentMethodFee(
          $exchange['payment_method'],
          $exchange['value']
      );

      $exchange['convertion_fee'] = $this->applyConvertionFee($exchange['value']);
      $exchange['discounted_value'] = $exchange['value'] - ($exchange['payment_method_fee'] + $exchange['convertion_fee']);
      $exchange['exchanged_value'] = round($exchange['discounted_value'] * $exchange['destination_currency_price'],2);
      
      $payment_method = PaymentMethod::firstWhere('slug', $request_data['payment_method']);

      $exchange['payment_method_name'] = $payment_method->name;
      
      return $exchange;
    }

    /**
     * Função responsável por aplicar taxa de método de pagamento
     *
     * @param string $slug
     * @param float|string $value
     * @return float
     */
    private function applyPaymentMethodFee(string $slug, float|string $value) : float
    {
        $payment_method = PaymentMethod::firstWhere('slug', $slug);

        return $value * $payment_method->fee / 100;
    }

    /**
     * Função responsável por aplicar taxa de conversão
     *
     * @param float|string $value
     * @return float
     */
    private function applyConvertionFee(float|string $value) : float
    {
        $convertion_fee = ConvertionFee::active()->first();

        if ($value <= $convertion_fee->base_value) {
            $fee = $convertion_fee->lt_fee;
        } elseif ($value >= $convertion_fee->base_value) {
            $fee = $convertion_fee->gt_fee;
        } else {
            $fee = 0;
        }

        return $value * $fee / 100;
    }


  // public function exchangeteste($data)
  // {
  //   $teste= $this->gettax();
  //   return $data;
  // }

  // public function gettax()
  // {
  //   return 1;
  // }
}