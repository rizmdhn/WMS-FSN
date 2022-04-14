<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Product;
use App\Purchase;
use App\Record;
use App\Sell;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class checkrecord implements ShouldQueue
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
        $year = Carbon::now()->year;
        $date = Carbon::now()->toDateString();
        $month = Carbon::now()->month;
        foreach($product as $key =>$produk){    
            $totalRec = Record::where([['id_produk','=', $produk->id_produk]
            ])->get();
            foreach($totalRec as $rec){
                $totalsell = 0;
                $totalpurc = 0;
                $month =  Carbon::createFromFormat('Y-m-d', $rec->Tanggal)->month;
                $year =  Carbon::createFromFormat('Y-m-d', $rec->Tanggal)->year;
                $total_sell = Sell::where('id_produk', $produk->id_produk)->whereMonth('tgl_sell', $month)
                ->whereYear('tgl_sell', '<=', $year)->get();
                $total_purchase = Purchase::where('id_produk', $produk->id_produk)->whereMonth('tgl_purchase', $month)
                ->whereYear('tgl_purchase', '<=', $year)->get();
                foreach($total_purchase as $total ){
                    $totalpurc = $totalpurc + $total->qty_purchase;
                }
                foreach($total_sell as $total ){
                    $totalsell = $totalsell + $total->qty;
                }
                $recordprod = Record::where([['id_produk','=', $produk->id_produk]
                ,['tanggal', '<=',  $date]
                ])
               // ->whereMonth('tanggal','<=', $x)->whereYear('tanggal','<=', $year)
                ->orderby('tanggal', 'desc')->take(2)->get();
                if($recordprod->count() > 1){
                    $input['stokawal_produk'] = $recordprod[1]->stokakhir_produk;
                }
                else{
                    $input['stokawal_produk'] = $recordprod[0]->stokawal_produk; 
                }
                $input['qty_masuk'] = $totalpurc;
                $input['qty_keluar'] = $totalsell;
                $input['stokakhir_produk'] = ($input['stokawal_produk'] + $totalpurc - $totalsell);
                Record::where('id_record',$recordprod[0]->id_record)->update($input);
            }
            dispatch(new FSN());
            
        }
    }
}
