<?php

namespace App\Http\Controllers;

use App\Helpers\Helper\Helper;
use App\Models\Trade;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CryptoTradeController extends Controller
{

    public function index(Request $request)
    {
        $data['title'] = 'Trade';

        $data['trades'] = Trade::when($request->trx, function ($item) use ($request) {
            $item->where('ref', $request->trx);
        })->when($request->date, function ($item) use ($request) {
            $item->whereDate('trade_opens_at', $request->date);
        })->where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(Helper::pagination());

        return view(Helper::theme() . 'user.trading')->with($data);
    }

    public function latestTicker(Request $request)
    {
        $general = Helper::config();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://min-api.cryptocompare.com/data/v2/histominute?fsym={$request->currency}&tsym=USD&limit=40&api_key=" . $general->crypto_api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        $result = json_decode($response);


        $hvoc = $result->Data->Data;

        $chartData = [];

        foreach ($hvoc as $key => $value) {
            $chartData[$key] = [
                'x' => $value->time,
                'y' => [$value->open, $value->high, $value->low, $value->close]
            ];
        }

        curl_close($curl);

        return response()->json($chartData);
    }

    public function currentPrice(Request $request)
    {

        $general = Helper::config();

        $currency = $request->currency;

        $data = json_decode(file_get_contents("https://min-api.cryptocompare.com/data/price?fsym={$request->currency}&tsyms=USD&api_key=" . $general->crypto_api), true);


        $result = reset($data);

        return response()->json($result);
    }

    public function trades()
    {
        $data['trades'] = Trade::where('user_id', auth()->id())->paginate(Helper::pagination());

        $data['title'] = 'Trades List';

        return view(Helper::theme() . 'user.trade_list')->with($data);
    }


    public function openTrade(Request $request)
    {
        $request->validate([
            "trade_cur" => "required",
            "trade_price" => "required",
            "type" => "required|in:buy,sell",
            "duration" => "required|gt:0"
        ]);

        $user = auth()->user();


        if ($user->trades->count() >= Helper::config()->trade_limit) {
            return redirect()->back()->with('error', 'Per Day Trading Limit expired');
        }

        if ($user->payments->count() <= 0) {
            return redirect()->back()->with('error', 'You need to subscribe a plan to trade');
        }



        if ($user->balance < Helper::config()->min_trade_balance) {
            return redirect()->back()->with('error', 'You need minimum of ' . Helper::formatter(Helper::config()->min_trade_balance) . ' To Trade');
        }


        $ref = Str::random(16);

        Trade::create([
            'ref' => $ref,
            'user_id' => auth()->id(),
            'currency' => $request->trade_cur,
            'current_price' => $request->trade_price,
            'trade_type' => $request->type,
            'duration' => $request->duration,
            'trade_stop_at' => now()->addMinutes($request->duration),
            'trade_opens_at' => now()
        ]);

        return redirect()->back()->with('success', 'Trade Open Successfully');
    }

    public function tradeClose()
    {
        $config = Helper::config();

        $trades = Trade::where('user_id', auth()->id())->where('status', 0)->get();



        foreach ($trades as  $trade) {

            if ($trade->trade_stop_at->lte(now())) {

                $data = json_decode(file_get_contents("https://min-api.cryptocompare.com/data/price?fsym={$trade->currency}&tsyms=USD&api_key=" . $config->crypto_api), true);

                $currentPrice = reset($data);

                if ($currentPrice > $trade->current_price) {

                    // calculations
                    $amount = $currentPrice - $trade->current_price;
                    $charge = ($config->trade_charge / 100) * $amount;
                    $userAmount = $amount - $charge;
                    $type = '+';


                    // Trading Part 
                    $trade->profit_type = $type;
                    $trade->profit_amount = $amount;
                    $trade->charge = $charge;
                    $trade->status = 1;


                    // User Part
                    $trade->user->balance += $userAmount;
                    $trade->user->save();
                } else {

                    // calculations
                    $amount = $trade->current_price - $currentPrice;
                    $charge = 0;
                    $userAmount = $amount;
                    $type = '-';

                    // Trading Part 
                    $trade->profit_type = $type;
                    $trade->loss_amount = $amount;
                    $trade->charge = 0;
                    $trade->status = 1;

                    // User Part
                    $trade->user->balance -= $userAmount;
                    $trade->user->save();
                }

                $trade->save();

                Transaction::create([
                    'trx' => $trade->ref,
                    'amount' => $amount,
                    'details' => 'Trade Return',
                    'charge' => $charge,
                    'type' => $type,
                    'user_id' => $trade->user->id
                ]);
            }
        }
    }


    public function tradingInterest()
    {

        $config = Helper::config();

        $trades = Trade::where('status', 0)->get();

        foreach ($trades as  $trade) {

            if ($trade->trade_stop_at->lte(now())) {

                $data = json_decode(file_get_contents("https://min-api.cryptocompare.com/data/price?fsym={$trade->currency}&tsyms=USD&api_key=" . $config->crypto_api), true);

                $currentPrice = reset($data);

                if ($currentPrice > $trade->current_price) {

                    // calculations
                    $amount = $currentPrice - $trade->current_price;
                    $charge = ($config->trade_charge / 100) * $amount;
                    $userAmount = $amount - $charge;
                    $type = '+';


                    // Trading Part 
                    $trade->profit_type = $type;
                    $trade->profit_amount = $amount;
                    $trade->charge = $charge;
                    $trade->status = 1;


                    // User Part
                    $trade->user->balance += $userAmount;
                    $trade->user->save();
                } else {

                    // calculations
                    $amount = $trade->current_price - $currentPrice;
                    $charge = 0;
                    $userAmount = $amount;
                    $type = '-';

                    // Trading Part 
                    $trade->profit_type = $type;
                    $trade->loss_amount = $amount;
                    $trade->charge = 0;
                    $trade->status = 1;

                    // User Part
                    $trade->user->balance -= $userAmount;
                    $trade->user->save();
                }

                $trade->save();

                Transaction::create([
                    'trx' => $trade->ref,
                    'amount' => $amount,
                    'details' => 'Trade Return',
                    'charge' => $charge,
                    'type' => $type,
                    'user_id' => $trade->user->id
                ]);
            }
        }
    }
}
