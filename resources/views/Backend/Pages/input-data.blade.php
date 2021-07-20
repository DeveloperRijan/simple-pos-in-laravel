@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')

<!-- yield content here -->
<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Input Data</h4>
      <p class="card-description"> Fill the form to input data....</p>
      @include('msg.msg')
      <form class="forms-sample" action="{{ route('application.input.store') }}" 
        method="POST" id="input_data_form">
        @csrf
        <div class="form-group">
          <label for="store_id"><b>Select Store</b></label>
          @if(!$stores->isEmpty())
          <select class="form-control" name="store_id">
            <option value="">Select One</option>
            @foreach($stores as $store)
            <option value="{{ $store->id }}">{{ $store->store_name }}</option>
            @endforeach
          </select>
          @else
          <h4 style="color: red">Please created store first then input data....</h4>
          @endif

        </div>

        <div class="form-group">
          <label for="order_number_tokopedia"><b>Order Number Tokopedia</b></label>
          <input name="order_number_tokopedia" type="text" class="form-control" placeholder="Enter order number of Tokopedia" accept="*">
        </div>
        
        <div class="form-group">
          <!-- item_selling is representing quantity -->
          <label for="item_selling"><b>Item Price Selling</b></label>
          <input name="item_selling" type="number" class="form-control" placeholder="Enter item selling...">
        </div>
        
        <div class="form-group">
          <label for="item_cost"><b>Item Cost</b></label>
          <input name="item_cost" type="number" class="form-control" placeholder="Enter item cost...">
        </div>
        
        <div class="form-group">
          <label for="order_number"><b>Order Number</b></label>
          <input name="order_number" type="text" class="form-control" placeholder="Enter order number" accept="*">
        </div>
        
        <div class="form-group">
          <label for="tracking"><b>Tracking</b></label>
          <input name="tracking" type="text" class="form-control" placeholder="Enter tracking...">
        </div>
        
        <div class="form-group">
          <label for="information"><b>Information</b></label>
          <input name="information" type="text" class="form-control" placeholder="Enter information...">
        </div>
       
        <!--add note functionality temporary off-->
        <div class="form-group" style="display:none">
          <label><b>Add Note (Optional)</b></label>
          <br>
          <button type="button" class="btn btn-primary"
            data-toggle="modal" data-target="#addNote"
            >Add Note</button>

          <!-- note adding modal -->
          <div class="modal fade" id="addNote" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle"><b>Write note (optional)</b></h5>
                  <button type="button" id="clearNote" class="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                  <textarea id="notes" name="notes" class="form-control" cols="8" rows="10" placeholder="Enter note about this record...."></textarea>

                </div>
                <div class="modal-footer">
                  <button id="saveNote" type="button" class="btn btn-primary btn-sm">Save</button>
                </div>
              </div>
            </div>
          </div>
          <!-- note adding modal -->

        </div>
        <br>
        <br>
        <button id="submit_btn" type="submit" class="btn btn-success">Save Data</button>
        <a href="{{ route('application.input.index') }}" class="btn btn-danger">Go to all data</a>
      </form>

      <img id="submit_info_form_process" src="{{ asset('images/processing/processing.gif') }}">
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    //save modal data
    $("#saveNote").on("click", function(){
      $("#addNote").modal('hide')
    })

    $("#clearNote").on("click", function(){
      $("#notes").val('')
      $("#addNote").modal('hide')
    })

  })


</script>
@endpush