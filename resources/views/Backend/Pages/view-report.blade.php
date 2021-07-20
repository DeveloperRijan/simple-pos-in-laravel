@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')

<!-- yield content here -->
<div class="col-md-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h4 class="card-title mb-0">Report</h4>
      </div>
      <p>You are showing monthly report </p>
      <div>
        <p><a href="{{ route('home') }}" class='btn btn-danger btn-sm'>Back</a></p>
        
        <h6><b>Total Orders</b>:
          @if($totalOrders)
            {{ $totalOrders }}
          @endif
        </h6>
        
      </div>
      
      @include('msg.msg')
      
      <div class="table-responsive">
        
        <div class="analyticsBlock">
            <h4 class="text-center">Report for - 
            @if($month == 1)
            {{'January'}},
            @elseif($month == 2)
            {{'February'}},
            @elseif($month == 3)
            {{ 'March' }},
            @elseif($month == 4)
            {{ "April" }},
            @elseif($month == 5)
            {{ "May" }},
            @elseif($month == 6)
            {{ "Jun" }},
            @elseif($month == 7)
            {{ "July" }},
            @elseif($month == 8)
            {{ "August" }},
            @elseif($month == 9)
            {{ "September" }},
             @elseif($month == 10)
            {{ "October" }},
            @elseif($month == 11)
            {{ "November" }},
            @elseif($month == 12)
            {{ "December" }},
            @else
            {{ 'Something Wrong' }}
            @endif
            
            {{ $year }}</h4>
    		<div class="row text-center">
    			
    			<div class="col-md-4 single">
    				<div class="heading">
    					<h6>Total Item Selling</h6>
    				</div>
    
    				{{ $report_list[0] }}
    			</div>
    
    			<div class="col-md-4 single">
    				<div class="heading">
    					<h6>Total Item Cost</h6>
    				</div>
    
    				{{ $report_list[1] }}
    			</div>
    
    			<div class="col-md-4 single">
    				<div class="heading">
    					<h6>Total Profit</h6>
    				</div>
    
    				{{ $report_list[2] }}
    			</div>
    
    		</div>
		
        </div>
        
        
        <!--Show all records-->
        <table class="table table-striped table-hover" 
        style='margin-top:40px'>
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



@push('backendCSS')
<style type="text/css">

	.analyticsBlock{
		margin-top: 65px
	}
	.analyticsBlock h4{
		text-transform: uppercase;
	    font-weight: bold;
	    border-bottom: 5px solid #ddd;
	    margin-bottom: 20px;
	    padding-bottom: 15px;
	    text-shadow: 0px 1px 2px #000;
	}
	.analyticsBlock .single{
		margin-bottom: 20px
	}
	.analyticsBlock .heading h6{
		font-weight: bold;
	    border: 1px solid #ddd;
	    padding: 5px 0;
	    border-bottom: 5px solid #ddd;
	    background: #777;
	    color: #fff;
	}
</style>
@endpush 