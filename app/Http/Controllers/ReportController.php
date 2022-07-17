<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Sell;
use App\Employee;
use App\Product;
use Barryvdh\DomPDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Json;

class ReportController extends Controller
{
    public function index(){
    	$sells = Sell::all()->where('status', '1')->sortByDesc('tgl_sell');
        return view('gudang.report.pengambilan', ['sells'=>$sells]);
    }

    public function destroy($id_sell)
    {
        $sells = Sell::find($id_sell);
        $sells->delete();
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
        $data = Sell::whereDate('tgl_sell', '>=', $startdate)
            ->whereDate('tgl_sell', '<=', $enddate)->where('status', '1')->get();
        

		return view('gudang.report.reportdownload', ['data'=>$data]);
    
    }
}
