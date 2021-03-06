<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Jobs\checkrecord;
use App\Purchase;
use App\Product;
use App\Record;
use App\Sell;
use Carbon\Carbon;
use Cron\MonthField;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{

    public function index()
    {
        $purchases = DB::table('purchases')->join('products', 'purchases.id_produk', '=', 'products.id_produk')
        ->join('users', 'purchases.id_karyawan', '=', 'users.id')
        ->select('purchases.*', 'products.*', 'users.*')
        ->where('status', '=', '0')->where('is_deleted', false)
        ->get();;
        $products  = Product::all();
        $data = array(
            'products'   => $products,
        );
        return view('gudang.purchase.index', ['purchases' => $purchases], $data);
    }


    public function store(Request $request)
    {
        $request['id_karyawan'] = Auth::user()->id;
        if (Purchase::create($request->all())) {
            $timestemp = $request->tgl_purchase;
            $month = Carbon::createFromFormat('Y-m-d', $timestemp)->month;
            $record = Record::where('id_produk', $request->id_produk)->WhereMonth('tanggal', $month)->first();
            $recordlast = Record::where('id_produk', $request->id_produk)->WhereMonth('tanggal', $month - 1)->first();
            if (is_null($record)) {
                $product = Product::where('id_produk', $request->id_produk)->first();
                $data['id_produk'] = $product->id_produk;
                $data['kode_produk'] = $product->kode_produk;
                $data['nama_produk'] = $product->nama_produk;
                if (is_null($recordlast)) {
                    $data['stokawal_produk'] = $product->stok_produk - $request->qty_purchase;
                } else {
                    $data['stokawal_produk'] = $recordlast->stokakhir_produk;
                }
                $data['tanggal'] = $timestemp;
                $data['qty_masuk'] = $request->qty_purchase;
                $data['stokakhir_produk'] = ($product->stok_produk);
                Record::create($data);
                dispatch(new checkrecord());
            } else {
                dispatch(new checkrecord());
            }
        };

        return redirect('purchase')->with('pesan', 'Data berhasil direkam');
    }


    public function destroy($id_purchase)
    {
        $purchases = Purchase::find($id_purchase);
        $purchases->delete();
        dispatch(new checkrecord());
        return back()->with('pesan', 'Data telah dihapus!');
    }
    public function destroyNotif($id_purchase)
    {
        $purchases = Purchase::find($id_purchase);
        $purchases['is_deleted'] = true;
        $date = Carbon::now()->format('Y-m-d');
        Log::info($date);
        if($purchases->save()){
            $input['tgl_sell'] = $date;
            $input['id_karyawan'] = Auth::user()->id;
            $input['id_produk'] = $purchases->id_produk;
            $input['qty'] = $purchases->qty_purchase;
            $input['status'] = 1;
            if (Sell::create($input)) {
                // $month = Carbon::createFromFormat('Y-m-d', $date)->month;
                // $year = Carbon::createFromFormat('Y-m-d', $date)->year;
    
                // $record = Record::where('id_produk', $purchases->id_produk)->WhereMonth('tanggal', $month)
                //     ->whereYear('tanggal', '=', $year)->first();
                // $recordlast = Record::where('id_produk',  $purchases->id_produk)->WhereMonth('tanggal', ($month - 1))
                //     ->whereYear('tanggal', '=', $year)->first();
                // if (is_null($record)) {
                //     $product = Product::where('id_produk',  $purchases->id_produk)->first();
                //     $data['id_produk'] = $product->id_produk;
                //     $data['kode_produk'] = $product->kode_produk;
                //     $data['nama_produk'] = $product->nama_produk;
                //     if (is_null($recordlast)) {
                //         $data['stokawal_produk'] = $product->stok_produk + $purchases->qty_purchase;
                //     } else {
                //         $data['stokawal_produk'] = $recordlast->stokakhir_produk;
                //     }
                //     $data['qty_keluar'] = $purchases->qty_purchase;
                //     $data['tanggal'] = $date;
                //     $data['stokakhir_produk'] = ($product->stok_produk - $purchases->qty_purchase);
                //     Record::create($data);
                // } 
            };
        };
        dispatch(new checkrecord());
        return back()->with('pesan', 'Stok barang telah dihapus!');
    }

    public function update()
    {
        $purchases = Purchase::where('status', '0');
        $purchases->update(['status' => '1']);
        return back()->with('pesan', 'Data dikirim ke laporan');
    }

}
