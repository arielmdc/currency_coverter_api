<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserHistoryService;

class UserHistoryController extends Controller
{
    private $user_history_service;

    public function __construct(UserHistoryService $user_history_service)
    {
        $this->user_history_service = $user_history_service;
    }

    public function getUserHistory(Request $request, $id)
    {
        return $user_history = $this->user_history_service->getHistory($id);
    }
}
