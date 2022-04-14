<?php

namespace App\Http\Controllers;

use App\Jobs\checkrecord;
use App\Product;
use App\Purchase;
use App\Record;
use App\Sell;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\C3\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Charts\MontlyViews;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockalert = array();
        $tanggal = array();
        $product = Product::all();
        $recordpermonth = collect();
            foreach($product as $key =>$produk){   
                $record = Record::where('id_produk' , $produk->id_produk)->latest()->take(1)->first();
                $records = Record::where('id_produk' , $produk->id_produk)->get();
                $stock = $produk->stok_produk;
                $minimum = (($record->stokawal_produk)*20/100);
                foreach($records as $item){
                    $month =  Carbon::createFromFormat('Y-m-d', $item->Tanggal)->month;
                    $year =  Carbon::createFromFormat('Y-m-d', $item->Tanggal)->year;
                    $date = $month .'-'.$year;
                    $permonthrecord = Record::whereMonth('tanggal',$month)->whereYear('tanggal', $year)->get();
                    $recordpermonth->put($date, $permonthrecord);
                   if(in_array($date, $tanggal)){
                   }else{
                   array_push($tanggal, $date);
                   }
                }
 
            if($stock <= $minimum) {
                $stockalert[$key] = $produk->nama_produk . ' ' . $produk->kode_produk; 
            }
            }
            Log::info($recordpermonth);
            dispatch(new checkrecord());
        

        return view('gudang.home',['pesan' => $stockalert, 'tanggal'=> array_slice($tanggal, -3, 3), 'chartdata' => $recordpermonth, 'product' => $product]);
    }

    public function record(Request $request){
        $validator = Validator::make($request->all(), [
            'date' => ['required','date'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => 'Validation Error : ' . $validator->errors()
            ],422);
        }
        $total = 0;
        $month =  Carbon::createFromFormat('Y-m-d', $request['date'])->month;
        $year =  Carbon::createFromFormat('Y-m-d', $request['date'])->year;
        $data = Record::whereMonth('Tanggal', $month)
        ->whereYear('Tanggal', '<=', $year)->get();
        // foreach ($data as $datas) {
        //         $total = $total + $datas['nominal'];
        //     }
        return compact($data);
    }
}
