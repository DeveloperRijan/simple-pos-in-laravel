<?php

namespace App\Http\Controllers\Backend\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BackendModels\Store;
use App\BackendModels\StoreData;
use Carbon\Carbon;
use Auth;

class InputDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        $getAllStores = Store::latest()->get();
        
        return view('Backend.Pages.chose-store', compact('getAllStores'));
        
        
    }
    
    
    //get data by store
    public function get_data($storeID){
        $output_data = StoreData::where('store_id', $storeID)
                        ->latest()
                        ->with(['get_stores', 'get_added_by', 'get_updated_by'])
                        ->paginate(20);

        return view('Backend.Pages.output', compact('output_data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get all stores
        $stores = Store::where('status', 1)
                    ->get();

        return view('Backend.Pages.input-data', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store_id = $information = 
        $order_number = $order_number_tokopedia =
        $tracking = $item_selling = $item_cost = 
        $profit = $notes = $added_by = NULL;

        //validate id
        if ($request->store_id === "" || !is_numeric($request->store_id)) {
            return response()->json("Please select store", 422);
        }elseif($request->store_id !== "" && !is_numeric($request->store_id)){
            return response()->json("Invalid Request", 422);
        }else{
            $store_id = $request->store_id;
        }


        //validate information
        if ($request->information === "") {
            $information = NULL;
        }else{
            $information = $request->information;
        }

        //validate order_number
        if ($request->order_number == "") {
            $order_number = NULL;
        }else{
            $order_number = $request->order_number;
        }
        
        //validate order_number
        if ($request->order_number_tokopedia == "") {
            $order_number_tokopedia = NULL;
        }else{
            $order_number_tokopedia = $request->order_number_tokopedia;
        }

        //validate tracking
        if ($request->tracking === "") {
            $tracking = NULL;
        }else{
            $tracking = $request->tracking;
        }

        //validate item_selling
        if ($request->item_selling === "" || !is_numeric($request->item_selling)) {
            return response()->json("Item Selling Required & Must be Numeric.", 422);
        }else{
            $item_selling = $request->item_selling;
        }

        //validate item_cost
        if ($request->item_cost === "" || !is_numeric($request->item_cost)) {
            return response()->json("Item Cost Required & Must be Numeric.", 422);
        }else{
            $item_cost = $request->item_cost;
        }

        
        //validate notes
        if ($request->notes === "") {
            $notes = NULL;
        }else{
            $notes = $request->notes;
        }
        
        //calculate profit
        $profit = $item_selling - $item_cost;
        
        //times
        $current = Carbon::now();
        $year = $current->format('Y');
        $month = $current->format('m');

        //now store data
        $inserted = StoreData::insert([
            'store_id'=>$store_id,
            'information'=>$information,
            'order_number'=>$order_number,
            'order_number_tokopedia'=>$order_number_tokopedia,
            'tracking'=>$tracking,
            'item_selling'=>$item_selling,
            'item_cost'=>$item_cost,
            'profit'=>$profit,
            'notes'=>$notes,
            'added_by'=>Auth::user()->id,
            'year'=>$year,
            'month'=>$month,
            'created_at'=>$current,
        ]);

        if ($inserted == true) {
            return response()->json([
                'success'=>true,
                'successMsg'=>'Data saved successfully.'
            ], 200);
        }else{
            return response()->json('Data not saved! something wrong...', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get data
        $data = StoreData::where('id', $id)->first();
        if ($data) {
        //Get stores
        $stores = Store::latest()->get();

        return view('Backend.Pages.edit-input', compact(
                        'data',
                        'stores'
                    ));

        }else{
            return redirect()->back()
                ->with('error', 'Sorry! Data not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $store_id = $information = 
        $order_number = $order_number_tokopedia =
        $tracking = $item_selling = $item_cost = 
        $profit = $notes = $added_by = NULL;

        //validate id
        if ($request->store_id === "" || !is_numeric($request->store_id)) {
            return response()->json("Please select store", 422);
        }elseif($request->store_id !== "" && !is_numeric($request->store_id)){
            return response()->json("Invalid Request", 422);
        }else{
            $store_id = $request->store_id;
        }


        //validate information
        if ($request->information === "") {
            $information = NULL;
        }else{
            $information = $request->information;
        }

        //validate order_number
        if ($request->order_number == "") {
            $order_number = NULL;
        }else{
            $order_number = $request->order_number;
        }
        
        //validate order_number
        if ($request->order_number_tokopedia == "") {
            $order_number_tokopedia = NULL;
        }else{
            $order_number_tokopedia = $request->order_number_tokopedia;
        }

        //validate tracking
        if ($request->tracking === "") {
            $tracking = NULL;
        }else{
            $tracking = $request->tracking;
        }

        //validate item_selling
        if ($request->item_selling === "" || !is_numeric($request->item_selling)) {
            return response()->json("Item Selling Required & Must be Numeric.", 422);
        }else{
            $item_selling = $request->item_selling;
        }

        //validate item_cost
        if ($request->item_cost === "" || !is_numeric($request->item_cost)) {
            return response()->json("Item Cost Required & Must be Numeric.", 422);
        }else{
            $item_cost = $request->item_cost;
        }

        
        //validate notes
        if ($request->notes === "") {
            $notes = NULL;
        }else{
            $notes = $request->notes;
        }
        
        //calculate profit
        $profit = $item_selling - $item_cost;


        //now update data
        $updated = StoreData::where('id', $id)
            ->update([
            'store_id'=>$store_id,
            'information'=>$information,
            'order_number'=>$order_number,
            'order_number_tokopedia'=>$order_number_tokopedia,
            'tracking'=>$tracking,
            'item_selling'=>$item_selling,
            'item_cost'=>$item_cost,
            'profit'=>$profit,
            'notes'=>$notes,
            'updated_by'=>Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]);

        if ($updated == true) {
            return response()->json([
                'success'=>true,
                'successMsg'=>'Data updated successfully.'
            ], 200);
        }else{
            return response()->json('Data not updated! something wrong...', 500);
        }
    }
    
    
    
    
    //get report
    
    public function get_report(){
        $year = Request()->get('year');
        $month = Request()->get('month');
        
        if($year !== "" || $month !== ""){
            $data = StoreData::where([
                    'year'=>(int)$year,
                    'month'=>(int)$month,
                ])->get();
            
            if(!$data->isEmpty()){
                
                $totalItemSelling_value = StoreData::where([
                    'year'=>(int)$year,
                    'month'=>(int)$month,
                ])->sum('item_selling');
                
                $totalItemCost_value = StoreData::where([
                    'year'=>(int)$year,
                    'month'=>(int)$month,
                ])->sum('item_cost');
                
                $totalProfit_value = StoreData::where([
                    'year'=>(int)$year,
                    'month'=>(int)$month,
                ])->sum('profit');
                
                
                //get all records/data list
                $output_data = StoreData::where([
                        'year'=>(int)$year,
                        'month'=>(int)$month,
                    ])
                    ->with('get_stores')
                    ->get();
                
                
                $totalOrders = count($data);
                $report_list = [$totalItemSelling_value, $totalItemCost_value, $totalProfit_value];
                
                return view('Backend.Pages.view-report', compact('totalOrders', 'year', 'month', 'report_list', 'output_data'));
            }else{
                return redirect()->back()
                ->with('error', 'Sorry No Data Found !!');
            }
            
        }else{
            return redirect()->back()
                ->with('error', 'Sorry Select Year & Month....');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = StoreData::where('id',$id)->first();
        if ($data) {
            $deleted = $data->delete();
            if ($deleted == true) {
                return redirect()->route('application.input.index')
                ->with('success', 'Data deleted successfully.');
            }else{
                return redirect()->back()
                ->with('error', 'Sorry! Something went wrong');
            }
        }else{
            return redirect()->back()
                ->with('error', 'Sorry! Data not found');
        }
    }
}
