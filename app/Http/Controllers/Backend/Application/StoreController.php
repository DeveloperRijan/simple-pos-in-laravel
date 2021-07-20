<?php

namespace App\Http\Controllers\Backend\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BackendModels\Store;
use App\BackendModels\StoreData;
use Carbon\Carbon;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return all stores
        $stores = Store::where('status', 1)
                    ->orderBy("created_at", "DESC")
                    ->paginate(15);
        return view("Backend.Pages.stores", compact("stores"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Backend.Pages.add-new");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //Store
        $store_name = NULL;

        //validate name
        if ($request->store_name == "") {
            return response()->json('Store Name required!', 422);
        }else{
            $store_name = $request->store_name;
        }

        //now insert data
        $inserted = Store::insert([
                'store_name'=>$store_name,
                'created_at'=>Carbon::now(),
            ]);

        if ($inserted == true) {
            return response()->json([
                'success'=>true,
                'successMsg'=>"Store added successfully.",
            ], 200);
        }else{
            return response()->json('Something went wrong please try again!', 500);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validate = $this->validate($request, [
            'store_name'=>'required'
        ]);

        $data = Store::where('id', $id)->first();

        if ($data) {
            //now insert data
            $updated = Store::where([
                    'id'=>$id,
                    'status'=>1,
                ])
                ->update([
                    'store_name'=>$request->store_name,
                    'updated_at'=>Carbon::now(),
                ]);

            if ($updated == true) {
                return redirect()->back()
                    ->with('success', 'Success, data updated');
            }else{
                return redirect()->back()
                    ->with('error', 'Sorry, There is problem .... to update data');
            }
            
        }else{
            return redirect()->back()
                    ->with('error', 'Store not found.');
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

       $data = Store::where('id', $id);
       if ($data) {

            $result = $this->deleteInputedData($id);

            if ($result === true) {
               $deleted = Store::where('id', $id)->delete();
               
               if ($deleted == true) {
                   return redirect()->back()
                    ->with('success', 'Store deleted successfully.');
               

               }else{
                    return redirect()->back()
                     ->with('error', 'Sorry internal error...');
               } 
            }
           
       }else{
            return redirect()->back()
                ->with('error', 'Store not found.');
       }
    }


    //first delete all inputed data associated with store
    private function deleteInputedData($id){
        //this id is the store id
        
        $idList = StoreData::where('store_id', $id)->get();

        if (!$idList->isEmpty()) {
            
            foreach ($idList as $value) {
                StoreData::where('id', $value->id)->delete();
            }

            return true;
        }else{
            return true;
        }
    }
}
