<?php

namespace App\Http\Controllers\Backend\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BackendModels\StoreData;
use App\BackendModels\Store;
use Carbon\Carbon;

class SearchController extends Controller
{
    
    // public function get_stores(){
    //     $stores = Store::where('status', 1)
    //             ->orderBy('id', 'ASC')
    //             ->get();
                
    //     //make html
    //     global $html_output;
    //     $html_output = "";
        
    //     foreach($stores as $store){
    //         $html_output .= "<option value='$store->id'>".$store->store_name."</option>";
    //     }
    //     return response()->json($html_output, 200); 
    // }
    
    
    //Search bar top
    public function search_top($searchIn, $searchKey){
    	if ($searchIn === "in_order_no") {
    		$data = $this->searchInOrderNumber($searchKey);
    		if ($data === false) {
    			return response()->json('No Data Found', 404);
    		}else{
    			return response()->json($data, 200);
    		}

    	}elseif ($searchIn === "tokopedia_order_number") {
    		$data = $this->searchInTokopediaOrderNumber($searchKey);
    		if ($data === false) {
    			return response()->json('No Data Found', 404);
    		}else{
    			return response()->json($data, 200);
    		}

    	}elseif ($searchIn === "inTracking") {
    		$data = $this->searchInTracking($searchKey);
    		if ($data === false) {
    			return response()->json('No Data Found', 404);
    		}else{
    			return response()->json($data, 200);
    		}

    	}else{
    		return response()->json('Error in Search By, Please try again later!', 422);
    	}
    }


    //search in email field field
    private function searchInOrderNumber($searchKey){
    	$data = StoreData::where([
    	                        ["order_number", "LIKE", "%$searchKey%"],
    	                        ])
    						->with('get_stores')
    						->get();
        
        if (!$data->isEmpty()) {
        	$organizedData = $this->formatDataAsTable($data);

        	return $organizedData;
          
        }else{
        	return false;
        }

    }

    //search in email field field
    private function searchInTokopediaOrderNumber($searchKey){
    	$data = StoreData::where([
    	                    ["order_number_tokopedia", "LIKE", "%$searchKey%"],
    	                   ])
    						->with('get_stores')
    						->get();
        
        if (!$data->isEmpty()) {
        	$organizedData = $this->formatDataAsTable($data);

        	return $organizedData;
          
        }else{
        	return false;
        }

    }
    
    //search in email field field
    private function searchInTracking($searchKey){
    	$data = StoreData::where([
    	                    ["tracking", "LIKE", "%$searchKey%"],
    	                   ])
    						->with('get_stores')
    						->get();
        
        if (!$data->isEmpty()) {
        	$organizedData = $this->formatDataAsTable($data);

        	return $organizedData;
          
        }else{
        	return false;
        }

    }



    //fomat search result
    private function formatDataAsTable($data){
    	global $output;
    	global $today;
    	$current_time = Carbon::now();
    	$today = $current_time->format("Y-m-d");

    	$output = "";
    	        
    	        $output .= "<div class='col-md-12 grid-margin'>";
    	        $output .= "<button id='closeTopSearchResult_btn' title='Close Search Result'><i class='fas fa-times'></i></button>";

		          $output .= "<div class='card' style='background:#ddd'>";
		            $output .= "<div class='card-body'>";
		              $output .= "<div class='top_search_result_heading d-flex justify-content-center'>";
		                $output .= "<h4 class='card-title mb-0'>SEARCH RESULT</h4>";
		              	$output .=  "</div> ";

		              	$output .= "<div class='table-responsive'>";
		                $output .= "<table class='table table-striped table-hover text-center'>";
		                $output .= "<thead>";
			                $output .= "<tr>";
			                $output .= "<th>SL.</th>";
			                $output .= "<th>Store</th>";
			                $output .= "<th>Order Number Name From Tokopedia</th>";
			                $output .= "<th>Iteam Price Selling</th>";
			                $output .= "<th>Iteam Cost</th>";
			                $output .= "<th>Profit</th>";
			                $output .= "<th>Order Number</th>";
			                $output .= "<th>Tracking</th>";
			                $output .= "<th>Information</th>";
			                $output .= "<th>Action</th>";
			                $output .= "</tr>";
		                $output .= "</thead>";
		                        
		                $output .= "<tbody>"; 
		            foreach($data as $key=>$value){
		                $output .= "<tr>";
		                $output .= "<td>".($key+1)."</td>";
		                $output .= "<td>".$value->get_stores->store_name."</td>";
		                $output .= "<td>".$value->order_number_tokopedia."</td>";
		                $output .= "<td>".$value->item_selling."</td>";
		                $output .= "<td>".$value->item_cost."</td>";
		                $output .= "<td>".$value->profit."</td>";
		                $output .= "<td>".$value->order_number."</td>";
		                $output .= "<td>".$value->tracking."</td>";
		                $output .= "<td>".$value->information."</td>";
		                
		                
		                
		                $output .= "<td>";
		                
		                $output .= "<a href='/application/input/".$value->id."/edit' class='btn btn-danger btn-sm' title='Edit'>";
		                $output .= "<i class='fas fa-edit'></i>";
		                $output .= "</a>";
		                $output .= "</td>";

		                $output .= "</tr>"; 
		                          
		            }           
		                      
		                    
		                $output .=  "</tbody>";
		            $output .=  "</table>";
		            $output .=  "</div>";
		        $output .=  "</div>";
		    $output .=  "</div>";
		$output .=  "</div>";

		                	          
		return $output;  
    }
}
