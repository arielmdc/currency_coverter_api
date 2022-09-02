<?php

namespace App\Http\Controllers;

// use App\Facades\ApiDeMoedaFacade;
use Illuminate\Http\Request;
use App\Services\ExchangeService;
use App\Services\UtilsService;
use App\Services\UserHistoryService;
use App\Models\UserHistory;

class ExchangeController extends Controller
{
    private $exchange_service;
    private $utils_service;
    private $user_history_service;

    public function __construct(ExchangeService $exchange_service, UserHistoryService $user_history_service, UtilsService $utils_service)
    {
        $this->exchange_service = $exchange_service;
        $this->utils_service = $utils_service;
        $this->user_history_service = $user_history_service;
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');

        $quote = $this->utils_service->getCurrencyQuote($request->origin_currency, $request->destination_currency);

        $exchange = $this->exchange_service->applyFees($input, $quote);

        $user_history = $this->user_history_service->saveHistory($input['user_id'],
            new UserHistory($exchange)
        );
        
        return $exchange;
    }
}
