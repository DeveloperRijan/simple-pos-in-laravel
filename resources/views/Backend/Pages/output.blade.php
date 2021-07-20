@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')

<!-- yield content here -->
<div class="col-md-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h4 class="card-title mb-0">Data List</h4>
      </div>
      <p>You are showing output data...</p>
      <div>
         <p>
            <a href="{{ route('application.input.index') }}" class="btn btn-danger">Back</a>
        </p>
        
        <h6>Total:
          @if(!$output_data->isEmpty())
            {{ $output_data->total() }}
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
              <th>Order Number Name From Tokopedia</th>
              <th>Iteam Price Selling</th>
              <th>Iteam Cost</th>
              <th>Profit</th>
              <th>Order Number</th>
              <th>Tracking</th>
              <th>Information</th>
              <th>Created at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(!$output_data->isEmpty())
            @foreach($output_data as $key=>$output)
            <tr>
              <td>{{  $key+1 }}</td>
              <td>{{ $output->get_stores->store_name }}</td>
              <td>{{ $output->order_number_tokopedia }}</td>
              <td>{{ $output->item_selling }}</td>
              <td>{{ $output->item_cost }}</td>
              <td>{{ $output->profit }}</td>
              <td>{{ $output->order_number }}</td>
              <td>{{ $output->tracking }}</td>
              <td>{{ $output->information }}</td>
              <td>{{ $output->created_at->format('Y-m-d h:m') }}</td>
              <td>
                <a href="{{ route('application.input.edit', $output->id) }}" class="btn btn-info btn-sm" title="Edit Data">
                  <i class="fas fa-edit"></i>
                </a>
                
                <!-- output delete code start from here -->
                  <form style="display:none;" id="delete-form-{{ $output->id }}" 
                    action="{{ route('application.input.destroy', $output->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                  </form>

                  <button type="button" class="btn btn-danger btn-sm"
                    onclick="if(confirm('Are you sure to Delete?')){
                      event.preventDefault();
                      document.getElementById('delete-form-{{ $output->id }}').submit();
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

            <tr>
              <td colspan="10">
                {!! $output_data->render() !!}
              </td>
            </tr>

            @else
            <tr>
              <td colspan="10">Data Not Found</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection