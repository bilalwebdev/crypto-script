<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //

    public function transac()
    {

        $data['accounts'] = auth()->user()->accounts;

        return view('backend.transactions.index')->with($data);
    }
}
