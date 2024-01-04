<?php

namespace App\Services\MT5;

use App\Models\Account;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class MT5Service
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('MT5_API_BASE_URL');
    }

    public function connectToMT5()
    {
        $response = Http::get("{$this->baseUrl}/Connect", [
            'user' => env('MT5_USERNAME'),
            'password' => urlencode(env('MT5_PASSWORD')),
            'server' => env('MT5_SERVER'),
            'timeout' => 15000,
        ]);

        if ($response->status() === 200) {
            return $response->body();
        }

        // return null;

    }

    public function getToken()
    {
        ///  $token = Cache::get('mt5_token');

        $token = 'abcX2123nb6po!7';

        if (!$token) {
            $token = $this->connectToMT5();
            if ($token) {
                Cache::put('mt5_token', $token, now()->addHours(1));
            }
        }
        return $token;
    }


    public function openAccount($leverage, $inves_pass, $mas_pass)
    {

        $id = $this->getToken();

        $url = $this->baseUrl . '/AccountCreate?id=' . $id . '&master_pass=' . $mas_pass . '
        &investor_pass=' . $inves_pass . '&enabled=true&Group=Active%20Broker%5CTrade%20Global&Leverage='
            . $leverage . '&firstName=' . Auth::user()->username . '&lastName=Test T';


        $response = Http::get($url);



        if ($response->status() === 200) {
            return $response->json();
        }
    }

    public function getAccount($login)
    {
        $id = $this->getToken();
        $response = Http::get("{$this->baseUrl}/AccountDetails", [
            'id' => $id,
            'login' => $login,
        ]);
        if ($response->status() === 200) {
            return $response->json();
        }
    }

    public function getAccountDetailsMany()
    {
        $id = $this->getToken();

        $userAccounts = Account::where('user_id', Auth::id())->get('login')->toArray();

        $arr = '';

        foreach ($userAccounts as $ac) {
            $arr .= '&login=' . $ac['login'];
        }

        $response = Http::get("{$this->baseUrl}/AccountDetailsMany?id=$id$arr");

        // dd($response->json());

        if ($response->status() === 200) {
            return $response->json();
        }
    }
    public function getAccountsSummary()
    {
        $id = $this->getToken();
        $response = Http::get("{$this->baseUrl}/AccountsSummary", [
            'id' => $id,
        ]);
        if ($response->status() === 200) {
            $result = $response->json();
            $AccountsSummary = [];
            foreach ($result as $account) {
                $login = $account['login'];
                $AccountsSummary[$login] = $account;
            }
            return $AccountsSummary;
        }
    }


    public function deposit($login, $amount, $status)
    {
        $status =  $status == 'false' ? false : true;


        if ($status == false) {
            $amount = '+' . $amount;
        } else {
            $amount = '-' . $amount;
        }




        $id = $this->getToken();

        $response = Http::get("{$this->baseUrl}/Deposit", [
            'id' => $id,
            'login' => $login,
            'amount' => $amount,
            'comment' => 'transaction',
            'credit' => $status,
        ]);

        //  dd($response->json());

        if ($response->status() == 200) {
            return $response->json();
        }
    }

    public function deleteAccount($login)
    {

        $response = Http::get("{$this->baseUrl}/AccountDelete", [
            'login' => $login,
        ]);

        if ($response->status() == 200) {
            return $response->json();
        }
    }
}
