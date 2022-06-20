<?php

namespace App\Jobs;

use App\gudang;
use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class checkgudang implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $product = Product::all();
       foreach ($product as $produk) {
        $totalstokprod = $produk->stok_produk * $produk->jumlah_enodes;
        $kategoriprod = $produk->Kategori_fsn;
        $id_gudang = $produk->id_gudang;
        $gudang = gudang::find($id_gudang);
        if($gudang != null){
            if ($kategoriprod == "1"){
                $gudang['sisa_f'] = $gudang->sisa_f - $totalstokprod;
            }else if ($kategoriprod == "2"){
                $gudang['sisa_s'] = $gudang->sisa_s - $totalstokprod;
            }else if ($kategoriprod == "3"){
                $gudang['sisa_n'] = $gudang->sisa_n - $totalstokprod;
            }
            $gudang->update();

            Log::info($kategoriprod);

        }
        Log::info('initotalproduct' . $produk->nama_produk . $produk->stok_produk);
    }

}   
}