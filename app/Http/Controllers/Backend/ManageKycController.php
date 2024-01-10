<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\KycDocs;
use Illuminate\Http\Request;

class ManageKycController extends Controller
{
    
    public function index(){

        $data['title'] = 'Kyc Documents';

        $data['kyc_docs'] = KycDocs::paginate(10);

        return view('backend.kyc.index', $data);
    }
}
