<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Sell;
use App\Employee;
use App\Product;
use Barryvdh\DomPDF;

class ReportController extends Controller
{
    public function index(){
    	$sells = Sell::all()->where('status', '1');
        return view('gudang.report.pengambilan', ['sells'=>$sells]);
    }

    public function destroy($id_sell)
    {
        $sells = Sell::find($id_sell);
        $sells->delete();
        return back()->with('pesan', 'Data berhasil dihapus');
    }
   
  
}
