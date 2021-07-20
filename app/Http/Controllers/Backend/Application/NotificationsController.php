<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BackendModels\Customer;
use App\BackendModels\Payment;
use Carbon\Carbon;

class NotificationsController extends Controller
{
    
    public $current_time;
    public $today;

    public function __construct(){
    	$this->current_time = Carbon::now();
    	$this->today = $this->current_time->format("Y-m-d");
    }

    //get notifications
    public function get_notifications(){
    	//get round date over notifications
    	$result = $this->getAllNotifications();
    	return $result;

    }

    //notifications
    public function getAllNotifications(){
    	$roundDateOver = Customer::Where([
    			['first_round_start_date', '!=', NULL],
    			['next_round_number', '!=', NULL],
    			['next_round_date', '!=', NULL],
                ['next_round_date', '<', $this->today],
    			['next_round_date', '>=', Carbon::now()->subDays(3)]
    		])
    		->orderBy('updated_at', 'DESC')
    		->get();


    	//due date over notifications
    	$getDueCustomers = Customer::where([
    			['due_payment_id', '!=', NULL]
    		])->get();

    	
    	//now get due row for each due customers
    	$dueCustomersData = [];
    	foreach ($getDueCustomers as $dueCustomer) {
    		$data = Payment::where([
									['id', '=', $dueCustomer->due_payment_id],
									['customer_id', '=', $dueCustomer->id],
                                    ['next_due_date_for_payment', '<', $this->today],
									['next_due_date_for_payment', '>=', Carbon::now()->subDays(3)],
    							])
    							->orderBy('created_at', 'DESC')
    							->with('get_customer')
    							->get();
    		if (!$data->isEmpty()) {
    			$dueCustomersData[] = $data;
    		}
    	}

    	//now call method for merge array
    	$result = $this->formatDataNow($roundDateOver, $dueCustomersData);
    	
    	
    	return $result;

    }


    public function formatDataNow($roundDateOver, $dueCustomersData){
    	//Notice-> round over date is an object & 
    	//due over date is an array 
    	$totalNotifications = "";
        if (!$roundDateOver->isEmpty() && !empty($dueCustomersData)) {
            $totalNotifications = count($roundDateOver) + count($dueCustomersData);
        
        }elseif (!$roundDateOver->isEmpty() && empty($dueCustomersData)) {
            $totalNotifications = count($roundDateOver);
        
        }elseif ($roundDateOver->isEmpty() && !empty($dueCustomersData)) {
            $totalNotifications = count($dueCustomersData);
        }elseif ($roundDateOver->isEmpty() && empty($dueCustomersData)) {
            $totalNotifications = 0;
        }
    	

    	//now make html
    	global $output;
    	$output = "";

    	$output .= "<a class='nav-link count-indicator' id='notificationDropdown' href='#' data-toggle='dropdown'>";
    	$output .= "<i class='fas fa-globe-europe'></i>";
    	$output .= "<span class='count bg-danger'>".$totalNotifications."</span>";
    	$output .= "</a>";

    	$output .= "<div class='dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0' aria-labelledby='notificationDropdown'>";
    	$output .= "<a class='dropdown-item py-3 border-bottom'>";
    	$output .= "<p class='mb-0 font-weight-medium float-left'>You have ".$totalNotifications." new notifications </p>";
    	$output .= "</a>";
    	
    	if(!$roundDateOver->isEmpty()){
    		foreach ($roundDateOver as $roundDateOverNoti) {
    			$output .= "<a href='/worker/customers/{$roundDateOverNoti->id}' class='dropdown-item preview-item py-3'>";
		    	$output .= "<div class='preview-item-content'>";
		    	$output .= "<h6 class='preview-subject font-weight-normal text-dark mb-1'>".$roundDateOverNoti->first_name." ".$roundDateOverNoti->last_name."'s </h6>";
		    	$output .= "<p class='font-weight-light small-text mb-0'> Round Date Over,  ".$roundDateOverNoti->next_round_date."</p>";
		    	$output .= "</div>";
		    	$output .= "</a>";
    		}
	    	
    	}

    	if(!empty($dueCustomersData)){
    		foreach ($dueCustomersData as $dueCustomers) {
    			foreach ($dueCustomers as $dueCustomer) {
	    			$output .= "<a href='/worker/customers/{$dueCustomer->customer_id}' class='dropdown-item preview-item py-3'>";
			    	$output .= "<div class='preview-item-content'>";
			    	$output .= "<h6 class='preview-subject font-weight-normal text-dark mb-1'>".$dueCustomer->get_customer->first_name.
			    					" ".$dueCustomer->get_customer->last_name."'s </h6>";
			    	$output .= "<p class='font-weight-light small-text mb-0'>Due Date Over, ".$dueCustomer->next_due_date_for_payment."</p>";
			    	$output .= "</div>";
			    	$output .= "</a>";
    			}
    		}
	    	
    	}



    	$output .= "</div>";

    return $output;

    }
    
}
