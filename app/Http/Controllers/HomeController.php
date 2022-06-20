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
use App\gudang;
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
        $expiryalert = array();
        $gudangalert = array();
        $tanggal = array();
        $TotalPemakaian = collect([
            'F' => 0,
            'S' => 0,
            'N' => 0,
        ]);
        $product = Product::all();
        $today =  Carbon::now()->format('Y-m-d');
        $recordpermonth = collect();
            foreach($product as $key =>$produk){
                $records = Record::where('id_produk' , $produk->id_produk)->get();
                if($records->isNotEmpty()){
                    $record = $records->last();
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
                $purchase = Purchase::where('expired' , '<=', $today)->where('id_produk' , $produk->id_produk)->where('is_deleted', false)->get();  
                if($purchase->isNotEmpty()) {
                    foreach($purchase as $item){
                        $expiryalert[$key] = $produk->nama_produk . ' ' . $produk->kode_produk . ' sejumlah ' . $item->qty_purchase . ' |'; 
                    }
                }
                if($stock <= $minimum) {
                    $stockalert[$key] = $produk->nama_produk . ' ' . $produk->kode_produk; 
                }
                }else{
                }
           

            }
            dispatch(new checkrecord());
            $gudang = gudang::first();
            if ($gudang->sisa_f <= 100){
                $gudangalert['f'] = $gudang->nama_gudang . ' Kapasitas Barang Fast Menipis' ;
            } else if ($gudang->sisa_s <= 100){
                $gudangalert['s'] = $gudang->nama_gudang . ' Kapasitas Barang Slow Menipis' ;
            } else if ($gudang->sisa_n <= 100){
                $gudangalert['n'] = $gudang->nama_gudang . ' Kapasitas Barang Not Moving Menipis' ;
            }
             Log::info($gudangalert);
        return view('gudang.dashboard',['pesanstock' => $stockalert,'pesanexpired' => $expiryalert, 'pesangudang' => $gudangalert, 'tanggal'=> array_reverse($tanggal), 'chartdata' => $recordpermonth, 'product' => $product, 'gudang' => $gudang]);
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
