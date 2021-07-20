@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')

<!-- yield content here -->
<div class="col-md-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h4 class="card-title mb-0">Question List</h4>
      </div>
      <p>You are showing questions data...</p>
      <div>
         <p>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
              Add New
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Add New Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route('application.question.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label><b>Select Store</b></label>
                            <br>
                            <select name='store_id' class="form-control" required="1">
                                <option value=''>Select One</option>
                                @if(!$stores->isEmpty())
                                @foreach($stores as $store)
                                <option value='{{ $store->id }}'>{{ $store->store_name }}</option>
                                @endforeach
                                @endif
                            </select>
                            
                        </div>
                        
                        <div class="form-group">
                            <label><b>Question</b></label>
                            <br>
                            <input type="text" class="form-control" name="question" placeholder="Enter question...." required="1">
                        </div>
                        <div class="form-group">
                            <label><b>Buyer Name</b></label>
                            <br>
                            <input type="text" class="form-control" name="buyer_name" placeholder="Enter buyer name...." required="1">
                        </div>
                        
                        <div class="form-group">
                            <label><b>Select Date</b></label>
                            <br>
                            <input type="date" class="form-control" name="date" required="1">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Add</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
            </div>
        </p>
        
        <h6>Total:
          @if(!$questions->isEmpty())
            {{ count($questions) }}
            @else
            {{ '0' }}
          @endif
        </h6>
        
      </div>
      
      @include('msg.msg')
      
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>SN.</th>
              <th>Store</th>
              <th>Question</th>
              <th>Buyer Name</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(!$questions->isEmpty())
            @foreach($questions as $key=>$question)
            <tr>
              <td>{{  $key+1 }}</td>
              <td>{{ $question->get_stores->store_name }}</td>
              <td>{{ $question->question }}</td>
              <td>{{ $question->buyer_name }}</td>
              <td>{{ $question->date }}</td>
              <td>
                <a href="{{ route('application.question.edit', $question->id) }}" class="btn btn-info btn-sm" title="Edit Data">
                  <i class="fas fa-edit"></i>
                </a>
                
                <!-- output delete code start from here -->
                  <form style="display:none;" id="delete-form-{{ $question->id }}" 
                    action="{{ route('application.question.destroy') }}" method="post">
                    @csrf
                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                  </form>

                  <button type="button" class="btn btn-danger btn-sm"
                    onclick="if(confirm('Are you sure to Delete?')){
                      event.preventDefault();
                      document.getElementById('delete-form-{{ $question->id }}').submit();
                    }else{
                      event.preventDefault();
                    }"
                  >
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <!-- output delete code end from here -->
              </td>
            </tr>
            @endforeach

            @else
            <tr>
              <td colspan="5">Data Not Found</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection