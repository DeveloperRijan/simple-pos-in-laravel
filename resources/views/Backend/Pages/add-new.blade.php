@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')
      
  <!-- yield content here -->
  <div class="col-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Add New Store</h4>
          <form class="forms-sample" id="addNewForm" action="{{ route('application.stores.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="store_name">* Store Name</label>
              <input type="text" name="store_name" class="form-control" placeholder="Enter store name...">
            </div>

            <button id="submit_btn" type="submit" class="btn btn-success mr-2">Add</button>
          </form>
        </div>

        <!-- display link to go the last inserted customer -->
        <p id="display_link" style="text-align: center;"></p>
      </div>

      <img id="submit_info_form_process" src="{{ asset('images/processing/processing.gif') }}">
  </div>
    
@endsection  

