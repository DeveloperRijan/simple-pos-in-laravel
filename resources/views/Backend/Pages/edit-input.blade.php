@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')

<!-- yield content here -->
<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Input Data Edit</h4>
      <p class="card-description"> This page represent data editing....</p>
      @include('msg.msg')
      <form class="forms-sample" action="{{ route('application.input.update', $data->id) }}" 
        method="POST" id="input_data_edit_form">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="store_id"><b>Select Store</b></label>
          @if(!$stores->isEmpty())
          <select class="form-control" name="store_id">
            <option value="">Select One</option>
            @foreach($stores as $store)
            <option value="{{ $store->id }}" @php if($data->store_id == $store->id){ echo 'selected';} @endphp>{{ $store->store_name }}</option>
            @endforeach
          </select>
          @else
          <h4 style="color: red">Please created store first then input data....</h4>
          @endif

        </div>
        
        
        <div class="form-group">
          <label for="order_number_tokopedia"><b>Order Number Tokopedia</b></label>
          <input name="order_number_tokopedia" type="text" class="form-control" 
            value="{{ $data->order_number_tokopedia }}" accept="*">
        </div>
        
        <div class="form-group">
          <!-- item_selling is representing quantity -->
          <label for="item_selling"><b>Item Price Selling</b></label>
          <input name="item_selling" type="number" class="form-control" 
            value="{{ $data->item_selling }}">
        </div>

        <div class="form-group">
          <label for="item_cost"><b>Item Cost</b></label>
          <input name="item_cost" type="number" class="form-control" 
            value="{{ $data->item_cost }}">
        </div>
        
        
        <div class="form-group">
          <label for="order_number"><b>Order Number</b></label>
          <input name="order_number" type="text" class="form-control" 
            value="{{ $data->order_number }}" accept="*">
        </div>
        
         <div class="form-group">
          <label for="tracking"><b>Tracking</b></label>
          <input name="tracking" type="text" class="form-control" 
            value="{{ $data->tracking }}">
        </div>
        
        <div class="form-group">
          <label for="information"><b>Information</b></label>
          <input name="information" type="text" class="form-control" 
            value="{{ $data->information }}">
        </div>
        

        <div class="form-group" style="display:none">
          <label><b>Add Note (Optional)</b></label>
          <br>
          <button type="button" class="btn btn-primary"
            data-toggle="modal" data-target="#addNote"
            >Add Note</button>
            @if($data->notes !== NULL)
            <p style="margin: 10px 0;border: 1px solid #ddd;padding: 10px 5px;">
              <label><b>Present Note</b></label>
              <br>
              <?php echo $data->notes; ?>
            </p>
            @endif

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
                  
                  <textarea id="notes" name="notes" class="form-control" cols="8" rows="10" placeholder="Enter note about this record...."><?php echo $data->notes; ?></textarea>

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
        <button id="submit_btn" type="submit" class="btn btn-success">Update Data</button>
        <a href="{{ route('application.input.index') }}" class="btn btn-danger">Go to all data</a>
        
        
      </form>
      
      
      <br/>
      <form action="{{ route('application.input.destroy', $data->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Are you sure to delete?')" class='btn btn-warning'>Delete</button>
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
      //$("#notes").val('')
      $("#addNote").modal('hide')
    })

  })


</script>
@endpush