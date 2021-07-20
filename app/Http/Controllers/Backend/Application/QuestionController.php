<?php

namespace App\Http\Controllers\Backend\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BackendModels\Store;
use App\BackendModels\StoreData;
use App\BackendModels\Question;
use Carbon\Carbon;
use Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function questions()
    {
        
        $stores = Store::orderBy('id', 'ASC')->get();
        $questions = Question::latest()
                    ->with('get_stores')
                    ->get();
        
        return view('Backend.Pages.questions', compact('questions', 'stores'));
        
        
    }
    
    //store question
    public function question_add(Request $request){
        $store_id = $question = $buyer_name = $date = NULL;

        //validate store id
        if ($request->store_id === "") {
            return redirect()->back()
            ->with("error", "Please select store");
        
        }else{
            $store_id = $request->store_id;
        }
        
        //validate id
        if ($request->question === "") {
            return redirect()->back()
            ->with("error", "Please enter question");
        
        }else{
            $question = $request->question;
        }
        
        //validate id
        if ($request->buyer_name === "") {
            return redirect()->back()
            ->with("error", "Please enter buyer name");
        
        }else{
            $buyer_name = $request->buyer_name;
        }
    
        
        //validate id
        if ($request->date === "") {
            return redirect()->back()
            ->with("error", "Please enter date name");
        
        }else{
            $date = $request->date;
        }
        

        //now store data
        $inserted = Question::insert([
            'store_id'=>$store_id,
            'question'=>$question,
            'buyer_name'=>$buyer_name,
            'date'=>$date,
            'created_at'=>Carbon::now(),
        ]);

        if ($inserted == true) {
            return redirect()->back()
            ->with("success", "Question added successfully.");
        }else{
            return redirect()->back()
            ->with("error", "Sorry something worng.");
        }
    }
    
    
    //question edit
    public function question_edit($id){
        $question = Question::where('id', $id)->first();
        
        $getStores = Store::get();
        
        if($question){
            return view('Backend.Pages.question-edit', compact('question', 'getStores'));
        }else{
            return redirect()->back()
            ->with("error", "Sorry data not found.");
        }
    }
    
    
    public function question_update(Request $request){
        $store_id = $question = $buyer_name = $date = NULL;

        //validate store id
        if ($request->store_id === "") {
            return redirect()->back()
            ->with("error", "Please select store");
        
        }else{
            $store_id = $request->store_id;
        }
        
        //validate id
        if ($request->question === "") {
            return redirect()->back()
            ->with("error", "Please enter question");
        
        }else{
            $question = $request->question;
        }
        
        //validate id
        if ($request->buyer_name === "") {
            return redirect()->back()
            ->with("error", "Please enter buyer name");
        
        }else{
            $buyer_name = $request->buyer_name;
        }
    
        
        //validate id
        if ($request->date === "") {
            return redirect()->back()
            ->with("error", "Please enter date name");
        
        }else{
            $date = $request->date;
        }
        

        //now store data
        $updated = Question::where('id', $request->question_id)
            ->update([
                'store_id'=>$store_id,
                'question'=>$question,
                'buyer_name'=>$buyer_name,
                'date'=>$date,
                'updated_at'=>Carbon::now(),
            ]);

        if ($updated == true) {
            return redirect()->back()
            ->with("success", "Question updated successfully.");
        }else{
            return redirect()->back()
            ->with("error", "Sorry something worng.");
        }
    }
    
    
    
    //delete question
    public function question_destroy(Request $request){
        $data = Question::where('id', $request->question_id)->first();
        if ($data) {
            $deleted = $data->delete();
            if ($deleted == true) {
                return redirect()->back()
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
