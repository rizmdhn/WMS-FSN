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
use App\Jobs\checkgudang;
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
        dispatch(new checkrecord());
        dispatch(new checkgudang());
        $stockalert = array();
        $expiryalert = array();
        $gudangalert = array();
        $tanggal = array();
        $product = Product::all();
        $today =  Carbon::now()->format('Y-m-d');
        $recordpermonth = collect();
        $datatable = collect();
            foreach($product as $key =>$produk){
                $records = Record::where('id_produk' , $produk->id_produk)->get();
                if($records->isNotEmpty()){
                    $record = $records->last();
                    $stock = $produk->stok_produk;
                    $minimum = (($record->stokawal_produk)*20/100);
                    foreach($records as $item){
                        $month =  Carbon::createFromFormat('Y-m-d', $item->Tanggal)->month;
                        $year =  Carbon::createFromFormat('Y-m-d', $item->Tanggal)->year;
                        $date = $year .'-'. $month;
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
            foreach($tanggal as $tgl){
                $items = collect();
                $yearandmonth = explode('-', $tgl);
                $permonthrecord = Record::whereMonth('tanggal',$yearandmonth[1])->whereYear('tanggal', $yearandmonth[0])->get();
                $datatable->put($tgl, $permonthrecord);
                foreach ($permonthrecord as $key => $item) {
                    if ($item->qty_keluar > 0 || $item->qty_masuk > 0) {
                        $items->put($key,$item);
                    } 
                }
                $recordpermonth->put($tgl, $items);
                Log::info($recordpermonth);


            }


            $gudang = gudang::first();
            if (($gudang->sisa_F/100) <= 0.2){
                $gudangalert['f'] = $gudang->nama_gudang . ' Kapasitas Barang Fast Menipis' ;
            } else if (($gudang->sisa_S/100) <= 0.2){
                $gudangalert['s'] = $gudang->nama_gudang . ' Kapasitas Barang Slow Menipis' ;
            } else if (($gudang->sisa_N/100) <= 0.2){
                $gudangalert['n'] = $gudang->nama_gudang . ' Kapasitas Barang Not Moving Menipis' ;
            }
             Log::info($gudangalert);

        return view('gudang.dashboard',['pesanstock' => $stockalert,'pesanexpired' => $expiryalert, 'pesangudang' => $gudangalert, 'tanggal'=> array_reverse($tanggal), 'chartdata' => $recordpermonth, 'tabledata' => $datatable,'product' => $product, 'gudang' => $gudang]);
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
