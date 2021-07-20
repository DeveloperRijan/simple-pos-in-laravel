@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')

<!-- yield content here -->
<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Add New Worker</h4>
      <p class="card-description"> Fillup the form to create new worker</p>
      @include('msg.msg')
      <form class="forms-sample" action="{{ route('application.workers.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="worker_name">Worker Name</label>
          <input name="worker_name" type="text" class="form-control" id="worker_name" placeholder="Enter name" required="1">
        </div>
        <div class="form-group">
          <label for="worker_email">Email address</label>
          <input name="worker_email" type="email" class="form-control" id="worker_email" placeholder="Enter email" required="1">
        </div>
        <div class="form-group">
          <label for="worker_address">Address</label>
          <input name="worker_address" type="text" class="form-control" id="worker_address" placeholder="Enter address">
        </div>
        <div class="form-group">
          <label for="worker_password">Password</label>
          <input name="worker_password" type="password" class="form-control" id="worker_password" placeholder="Password" required="1">
        </div>
        <button type="submit" class="btn btn-success mr-2">Add</button>
        <a href="{{ route('application.workers.index') }}" class="btn btn-danger">Back</a>
      </form>
    </div>
  </div>
</div>

@endsection