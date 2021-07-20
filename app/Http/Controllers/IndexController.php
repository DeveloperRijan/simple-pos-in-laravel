<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Admin;

class IndexController extends Controller
{
    //Return Root Page
    public function index(){
    	return view('index');
    }

    //if someone try to get login route
    public function handle_request(){
    	return redirect()->route("homeIndexPage");
    }
}
