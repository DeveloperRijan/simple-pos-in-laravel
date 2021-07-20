<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BackendModels\StoreData;
use Carbon\Carbon;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $current_date;
    private $today;

    public function __construct()
    {
        $this->middleware('auth');
        $this->current_date = Carbon::now();
        $this->today = $this->current_date->format("Y-m-d");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $analytics = $this->getAnalytics();
        return view('Backend.dashboard', compact('analytics'));
    }


    private function getAnalytics(){
        $lastSevenDays = Carbon::now()->subDays(30);
        $today = Carbon::now();

        //item selling total
        $itemSellingTotal = DB::table('store_data')
        ->where([
            ['created_at', '>', $lastSevenDays],
            ['created_at', '<=', $today]
        ])
        ->sum('item_selling');
        
        //item cost total
        $itemCostTotal = DB::table('store_data')
        ->where([
            ['created_at', '>', $lastSevenDays],
            ['created_at', '<=', $today]
        ])
        ->sum('item_cost');

        //total profit

        $totalProfit = DB::table('store_data')
        ->where([
            ['created_at', '>', $lastSevenDays],
            ['created_at', '<=', $today]
        ])
        ->sum('profit');

        
        
        $data = [$itemSellingTotal, $itemCostTotal, $totalProfit];
        return $data;
    }
}
