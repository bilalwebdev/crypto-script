<?php

namespace App\Services;

use App\Helpers\Helper\Helper;
use App\Models\User;
use App\Models\Account;
use Carbon\Carbon;
use DB;
use App\Services\MT5\MT5Service;

class UserDashboardService
{

    protected $mt5Service;

    public function __construct(MT5Service $mt5Service)
    {
        $this->mt5Service = $mt5Service;
    }
    public function dashboard()
    {
        $user = auth()->user();

        $userAcounts = Account::where('user_id', $user->id)->get()->toArray();

        $data = array();

        $data['liveAccounts'] = [];

        $AccountsDetails = $this->mt5Service->getAccountDetailsMany();

        $data['liveAccounts'] = array_merge($AccountsDetails, $userAcounts);

        dd($data);

        return $data;
    }

    public function getAccount($login)
    {
        return $this->mt5Service->getAccount($login);
    }
}
