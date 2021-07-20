<?php

namespace App\Http\Controllers\Backend\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get workers list
        $workers = User::where([
                'deleted_at'=>NULL,
                'identity'=>"user",
            ])
            ->orderBy("created_at", 'DESC')
            ->get();
        return view('Backend.Pages.workers', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //add new worker
        return view('Backend.Pages.add-worker');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //add new worker
        $validate = $this->validate($request, [
            'worker_name'=>"required",
            'worker_email'=>"required|email",
            'worker_password'=>"required|min:6|max:16",
        ]);

        $inserted = User::insert([
                'name'=>$request->worker_name,
                'email'=>$request->worker_email,
                'address'=>$request->worker_address,
                'password'=>Hash::make($request->worker_password),
                'created_at'=>Carbon::now(),
            ]);
        if ($inserted == true) {
            return redirect()->back()
                ->with('success', 'Worker added successfully.');
        }else{
            return redirect()->back()
                ->with('error', 'Sorry, Something went wrong, please try agian later');
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
        //update worker
        $validate = $this->validate($request, [
            'worker_name'=>"required",
            'worker_email'=>"required|email",
        ]);

        if ($request->worker_password_new == "") {
            $updated = User::where('id', $id)
                    ->update([
                        'name'=>$request->worker_name,
                        'email'=>$request->worker_email,
                        'address'=>$request->worker_address,
                        'updated_at'=>Carbon::now(),
                    ]);
            if ($updated == true) {
                return redirect()->back()
                    ->with('success', 'Worker info. updated successfully.');
            }else{
                return redirect()->back()
                    ->with('error', 'Sorry, Something went wrong, please try agian later');
            }
        
        }elseif ($request->worker_password_new != "") {
            $validate = $this->validate($request, [
                'worker_password_new'=>"required|min:6|max:16",
            ]);

            $updated = User::where('id', $id)
                    ->update([
                        'name'=>$request->worker_name,
                        'email'=>$request->worker_email,
                        'address'=>$request->worker_address,
                        'password'=>Hash::make($request->worker_password_new),
                        'updated_at'=>Carbon::now(),
                    ]);
            if ($updated == true) {
                return redirect()->back()
                    ->with('success', 'Worker info. & password updated successfully.');
            }else{
                return redirect()->back()
                    ->with('error', 'Sorry, Something went wrong, please try agian later');
            }
        }else{
            return redirect()->back()
            ->with('error', 'Sorry, Something went wrong!');
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
        //detele
        if ($id == "" || !is_numeric($id)) {
            return redirect()->back()
            ->with("error", 'Sorry, there is a problem to indentify the worker!');
        }else{
            $deleted = User::findOrFail($id)->delete();
            if ($deleted == true) {
                return redirect()->back()
                ->with("success", 'Worker Deleted Successfully');
            }else{
                return redirect()->back()
                ->with("error", 'Sorry! Internal Server Error, Please try again later.');
            }
        }
    }
}
