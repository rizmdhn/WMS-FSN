<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Sell;
use App\Employee;
use App\Jobs\checkrecord;
use App\Product;
use App\Purchase;
use App\Record;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $sells = Sell::all();
        $sells = DB::table('sells')
                        ->join('products', 'sells.id_produk', '=', 'products.id_produk')
                        ->join('employees', 'sells.id_karyawan', '=', 'employees.id_karyawan')
                        ->select('sells.*', 'products.*', 'employees.*')
                        ->where('status','=', '0')
                        ->get();

        $employees = Employee::all();
        $products  = Product::all();
        $data = array(
            'employees'  => $employees,
            'products'   => $products,
        );
        return view('gudang.sell.index', ['sells'=>$sells], $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $stock = Product::where('id_produk', $request->id_produk)->first();
        if($request->qty > $stock->stok_produk){
            return redirect('sell')->with('pesan', 'Stok tidak cukup!');
        }
        if(Sell::create($request->all())){
            $timestemp = $request->tgl_sell;
        $month = Carbon::createFromFormat('Y-m-d', $timestemp)->month;
        $year = Carbon::createFromFormat('Y-m-d', $timestemp)->year;

         $record = Record::where('id_produk', $request->id_produk)->WhereMonth('tanggal', $month)
         ->whereYear('tanggal', '=', $year)->first();
         $recordlast = Record::where('id_produk', $request->id_produk)->WhereMonth('tanggal', ($month-1))
         ->whereYear('tanggal', '=', $year)->first();
         if(is_null($record)){
            $product = Product::where('id_produk', $request->id_produk)->first();
            $data['id_produk'] = $product->id_produk;
            $data['kode_produk'] = $product->kode_produk;
            $data['nama_produk'] = $product->nama_produk;
            if(is_null($recordlast)){
                $data['stokawal_produk'] = $product->stok_produk + $request->qty;
            }else{
                $data['stokawal_produk'] = $recordlast->stokakhir_produk;
            }
            $data['qty_keluar'] = $request->qty;
            $data['tanggal'] = $timestemp;
            $data['stokakhir_produk'] = ($product->stok_produk - $request->qty_purchase);
            Record::create($data);
         }else{
             dispatch(new checkrecord());
         }
        };
        return redirect('sell')->with('pesan', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_sell){
        $sells = Sell::find($id_sell);
        $sells->delete();
        dispatch(new checkrecord());
        // $timestemp = $sells->tgl_sell;
        // $month = Carbon::createFromFormat('Y-m-d', $timestemp)->month;
        // $year = Carbon::createFromFormat('Y-m-d', $timestemp)->year;
        // $record = Record::where('id_produk', $sells->id_produk)->WhereMonth('tanggal', $month)
        // ->whereYear('tanggal', '=', $year)->first();
        // $id = $record->id_record;
        //     $totalsell = 0;
        //     $totalpurc = 0;
        //     $total_sell = Sell::where('id_produk', $sells->id_produk)->whereMonth('tgl_sell', $month)
        //     ->whereYear('tgl_sell', '=', $year)->get();
        //     $total_purchase = Purchase::where('id_produk', $sells->id_produk)->whereMonth('tgl_purchase', $month)
        //     ->whereYear('tgl_purchase', '=', $year)->get();
        //     foreach($total_purchase as $total ){
        //         $totalpurc = $totalpurc + $total->qty_purchase;
        //     }
        //     foreach($total_sell as $total ){
        //         $totalsell = $totalsell + $total->qty;
        //     }
        //     $product = Record::where([['id_produk','=', $sells->id_produk],
        //     ['tanggal', '<=',  $timestemp]
        //     ])->orderby('tanggal', 'desc')->take(2)->get();
        //     $input['qty_masuk'] = $totalpurc;
        //     $input['qty_keluar'] = $totalsell;
        //     $input['stokakhir_produk'] = ($record->stokawal_produk + $totalpurc - $totalsell);
        //     Record::where('id_record',$id)->update($input);
        return redirect('sell')->with('pesan', 'pengambilan dibatalkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(){
        
        $sells = Sell::where('status', '0');
        $sells->update(['status'=>'1']);
        return back()->with('pesan', 'Data dikirim ke laporan');
    }
    

    public function report(){

        
    }
}
