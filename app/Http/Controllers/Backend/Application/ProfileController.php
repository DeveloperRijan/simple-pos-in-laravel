<?php

namespace App\Http\Controllers\Backend\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show profile
            return view("Backend.Pages.profile");
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
        //update profile
        $validate = $this->validate($request, [
                'name'=>"required",
                'email'=>"required|email",
            ]);

        if ($id == "" || !is_numeric($id)) {
            return redirect()->back()
                ->with('error', 'Sorry, there is a problem to identify your profile!');
        }else{
            $updated = User::where('id', $id)
                    ->update([
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'address'=>$request->address,
                        'updated_at'=>Carbon::now()
                    ]);
            if ($updated == true) {
                return redirect()->back()
                    ->with('success', 'Profile Updated Successfully.');
            }else{
                return redirect()->back()
                    ->with('error', 'Sorry, internal server error, please try again later.');
            }
        }
    }


    //change password
    public function change_password(Request $request){
        $validate = $this->validate($request, [
            'current_password'=>'required',
            'password'=>'required|min:8|max:33|confirmed',
        ]);

        $currentPass = $request->current_password;
        $new_password = $request->password;
        $passConfirmation = $request->password_confirmation;

        //First Check old password matched or not
        $match_current_pass = $this->check_old_pass($currentPass); 

        if ($match_current_pass == false) {
            return redirect()->back()
            ->with('error', 'Sorry! Current Password doesn`t match.');
        }else{
            //Update Password            
            $updated = User::where([
                            ['id', '=', Auth::user()->id],
                        ])
                        ->update([
                            'password'=>Hash::make($new_password)
                        ]);
            
            if ($updated) {
                  Auth::logout();
                  return redirect()->route('homeIndexPage')
                  ->with('success', 'Password updated successfully, please login with new password.');
              }else{
                return redirect()->back()
                ->with('error', 'Sorry, There is problem, please try again later.');
              }
        }
    }


    //check_old_pass
    private function check_old_pass($current_pass){
        $authAdminPass = Auth::user()->password;

        if (Hash::check($current_pass, $authAdminPass)) {
            return true;
        }else{
            return false;
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
        //
    }
}
