<?php

namespace App\Http\Controllers;

use App\Jobs\checkrecord;
use App\Product;
use App\Purchase;
use App\Record;
use App\Sell;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $records = array();

           
            $product = Product::all();
            foreach($product as $key =>$produk){   
                $records = Record::where('id_produk' , $produk->id_produk)->get();
                $record[$key] = $records;
            }
            dispatch(new checkrecord());
            
        return view('gudang.home',['record'=> $record]);
    }

}
