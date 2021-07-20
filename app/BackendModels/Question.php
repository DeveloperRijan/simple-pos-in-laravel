<?php

namespace App\BackendModels;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function get_stores(){
    	return $this->belongsTo('App\BackendModels\Store', 'store_id', 'id');
    }
}
