<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\KycDocs;
use Illuminate\Http\Request;

class ManageKycController extends Controller
{

    public function index()
    {

        $data['title'] = 'Kyc Documents';

        $data['kyc_docs'] = KycDocs::paginate(10);

        return view('backend.kyc.index', $data);
    }

    public function approve($id)
    {
        $doc = KycDocs::find($id);

        $doc->status = 1;

        $doc->save();

        return redirect()->back()->with('success', 'Successfully approved!');
    }
    public function reject($id)
    {
        $doc = KycDocs::find($id);

        $doc->status = 3;

        $doc->save();

        return redirect()->back()->with('success', 'Successfully rejeceted!');
    }
    public function delete($id)
    {
        $doc = KycDocs::find($id);

        $doc->delete();

        return redirect()->back()->with('success', 'Successfully deleted!');
    }
}
