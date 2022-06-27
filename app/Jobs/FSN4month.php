<?php

namespace App\Jobs;

use App\Product;
use App\Record;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;

class FSN4month implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $item;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->item->all();
        $totaldays = 0;
        $totalTOR = 0;
        $TOR = 0;
        foreach($this->item as  $item){
            $totaldays = $totaldays + $item['days'];
        }
        foreach ($this->item as $data) {
            if ($data['wsp'] != 0) {
                $TOR = $totaldays / $data['wsp'];
                $totalTOR = $totalTOR + $TOR;
            }else {
                $TOR = 0;
            }
            $input['TOR'] = $TOR;
            Record::where('id_record', $data['id_record'])->update($input);
         //   Product::where('id_produk', $data['id_produk'])->update($update);
         //   Log::info('FSN per record ' . $TOR . ' wsp '. $data['wsp']);
        }
      //  Log::info('TOR total per record ' . $totalTOR);
        $TOR4month = $totalTOR / 4;
        foreach($this->item as  $item){
            if ($TOR4month > 1) {
                $update['kategori_fsn'] = '1';
            } elseif ($TOR4month > 0.33) {
                $update['kategori_fsn'] = '2';
            } else {
                $update['kategori_fsn'] = '3';
            }
            $update['TOR4Months'] = $TOR4month;
            Product::where('id_produk', $item['id_produk'])->update($update);
        }
    //    Log::info('FSN4month ' . $TOR4month);

    }
}
