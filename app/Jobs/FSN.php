<?php

namespace App\Jobs;

use App\Product;
use App\Record;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

use function PHPSTORM_META\map;

class FSN implements ShouldQueue
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
        foreach ($product as $key => $produk) {
            $item = collect();
            $totaldays = 0;
            $PersedianRata2 = 0;
            $torpartial = 0;
            $wsp = 0;
            $TOR = 0;
            $totalRec = Record::where([
                ['id_produk', '=', $produk->id_produk]
            ])->get();
            foreach ($totalRec as $data) {
                $times = $data->Tanggal;
                $day = Carbon::parse($times)->daysInMonth;
                $totaldays = $day;
            }
            foreach ($totalRec as $rec) {
                $time = $rec->Tanggal;
                $days = Carbon::parse($time)->daysInMonth;
                $month = Carbon::parse($time)->month;
                $stokawal = $rec->stokawal_produk;
                $stokakhir = $rec->stokakhir_produk;
                $qtymasuk = $rec->qty_masuk;
                $qtykeluar = $rec->qty_keluar;
                if ($qtykeluar != 0 && $qtymasuk != 0) {
                    $PersedianRata2 = ($stokawal + $stokakhir) / 2;
                    $torpartial = $qtykeluar / $PersedianRata2;
                    $wsp = $days / $torpartial;
                    $TOR = $totaldays / $wsp;
                }else if ($qtykeluar == 0 || $qtymasuk == 0) {
                    $torpartial =0;
                    $wsp =0;
                    $TOR =0;   
                }
                $input['Rata2_persediaan'] = $PersedianRata2;
                $input['TOR_partial'] = $torpartial;
                $input['wsp'] = $wsp;
                $input['TOR'] = $TOR;
                // if ($TOR > 3) {
                //     $update['kategori_fsn'] = '1';
                // } elseif ($TOR > 1) {
                //     $update['kategori_fsn'] = '2';
                // } else {
                //     $update['kategori_fsn'] = '3';
                // }
                Record::where('id_record', $rec->id_record)->update($input);
                $TORrecord = collect(['nama_produk' => $rec->nama_produk,'days' => $days, 'TOR' => $TOR, 'id_produk' => $rec->id_produk, 'id_record' => $rec->id_record, 'wsp' => $wsp]);
                $item->push($TORrecord);
                if ($month%4 == 0) {
                    dispatch(new FSN4month($item));
                    $item = collect();
                }
            }
        }

    }
}
