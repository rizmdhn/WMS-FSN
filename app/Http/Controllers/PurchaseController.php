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

class PurchaseController extends Controller
{

    public function index()
    {

        $purchases = Purchase::all()->where('status', '0');

        $products  = Product::all();
        $data = array(
            'products'   => $products,
        );
        return view('gudang.purchase.index', ['purchases' => $purchases], $data);
    }


    public function store(Request $request)
    {

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
        return redirect('purchase')->with('pesan', 'Barang masuk dibatalkan!');
    }


    public function update()
    {

        $purchases = Purchase::where('status', '0');
        $purchases->update(['status' => '1']);
        return back()->with('pesan', 'Data dikirim ke laporan');
    }


    public function report()
    {
    }
}
