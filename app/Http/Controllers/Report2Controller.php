<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Purchase;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class Report2Controller extends Controller{

    public function index(){

    	$purchases = Purchase::all()->where('status', '1');
        return view('gudang.report2.index', ['purchases'=>$purchases]);
    }

    public function destroy($id_purchase)
    {
        $purchases = Purchase::find($id_purchase);
        $purchases->delete();
        return back()->with('pesan', 'Data berhasil dihapus');
    }

    public function getreportdatacustomDate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => [
                'required',
                'date'
            ],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => 'Validation Error : ' . $validator->errors()
            ], 422);
        }
        $startdate = Carbon::parse($request['start_date'])->format('Y-m-d');
        $enddate = Carbon::parse($request['end_date'])->format('Y-m-d');
        $data = Purchase::whereDate('tgl_purchase', '>=', $startdate)
            ->whereDate('tgl_purchase', '<=', $enddate)->where('status', '1')->get();
        

		return view('gudang.report.reportdownload', ['data'=>$data]);
    
    }
}
