<?php

namespace App\BackendModels;

use Illuminate\Database\Eloquent\Model;

class StoreData extends Model
{
    //
    public function get_stores(){
    	return $this->belongsTo('App\BackendModels\Store', 'store_id', 'id');
    }

    public function get_added_by(){
    	return $this->belongsTo('App\User', 'added_by', 'id');
    }

    public function get_updated_by(){
    	return $this->belongsTo('App\User', 'updated_by', 'id');
    }
}
