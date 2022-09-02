<?php

namespace App\Services;

use App\Events\ExchangeCreated;
use App\Models\User;
use App\Models\UserHistory;

class UserHistoryService
{
    public function saveHistory(int $id,UserHistory $user_history) : UserHistory
    {
        $user_history->user()->associate($id);
        $user_history->save();
        return $user_history;
    }

    public function getHistory(int $id)
    {
      $user_history = UserHistory::where('user_id', $id)->orderBy('created_at','DESC')->get();
      return $user_history;
    }
}
