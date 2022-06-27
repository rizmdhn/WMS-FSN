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
        $totalf = 0;
        $totals = 0;
        $totaln = 0;
        foreach ($product as $produk) {
            $totalstokprod = $produk->stok_produk * $produk->jumlah_enodes;
            $kategoriprod = $produk->Kategori_fsn;
            if ($kategoriprod == "1") {
                $totalf =  $totalf + $totalstokprod;
            } else if ($kategoriprod == "2") {
                $totals  =  $totals + $totalstokprod;
            } else if ($kategoriprod == "3") {
                $totaln =  $totaln + $totalstokprod;
            }

            Log::info($kategoriprod);

            Log::info('initotalproduct' . $produk->nama_produk . $produk->stok_produk);
        }

        $gudang = gudang::first();
        Log::info($gudang);
        $gudang['sisa_F'] = $gudang['Kapasitas_F'] - $totalf;
        $gudang['sisa_S'] = $gudang['Kapasitas_S'] - $totals;
        $gudang['sisa_N'] = $gudang['Kapasitas_N'] - $totaln;
        $gudang->update();
    }
}
