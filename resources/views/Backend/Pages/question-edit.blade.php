@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')

<!-- yield content here -->
<div class="col-md-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h4 class="card-title mb-0">Edit Question</h4>
      </div>
      <p>You are showing question data edit functionality...</p>
      <div>
         
        
      </div>
      
      @include('msg.msg')
      
      <div class="table-responsive">
        <form action="{{ route('application.question.update') }}" method="POST">
            @csrf
            <input type="hidden" name="question_id" value="{{ $question->id }}">
            <div class="form-group">
                <label><b>Store</b></label>
                <br>
                <select class="form-control" name="store_id" required="1">
                    @foreach($getStores as $store)
                    <option value="{{ $store->id }}" @php if($store->id == $question->store_id){ echo 'selected';} @endphp>{{ $store->store_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label><b>Question</b></label>
                <br>
                <input type="text" class="form-control" name="question" value="{{ $question->question }}" required="1">
            </div>
            <div class="form-group">
                <label><b>Buyer Name</b></label>
                <br>
                <input type="text" class="form-control" name="buyer_name" value="{{ $question->buyer_name }}" required="1">
            </div>
            
            <div class="form-group">
                <label><b>Select Date</b></label>
                <br>
                <input type="date" class="form-control" name="date" value="{{ $question->date }}" required="1">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection