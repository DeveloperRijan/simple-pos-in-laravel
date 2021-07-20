@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')
      
      
	<!-- yield content here -->
	<h3 class="text-center"><b>Welcome</b> - 
	@if(Auth::user()->identity === 'user')
	{{ Auth::user()->name }}, have a good day!</h3>

	@elseif(Auth::user()->identity === 'admin')
	<b>Admin</b> - {{ Auth::user()->name }}, have a good day!</h3>
	@else 
	{{ 'Something Wrong' }}
	@endif
	<br>

    @if(Auth::user()->identity === "admin")
	<div class="container analyticsBlock">
	    <div class='get_report'>
	        @php
	            $years = range(2020, 2025);
	        @endphp
	        <div class='row'>
	             <div class="col-md-3">
	             </div>
	             
	             
	             <div class="col-md-6">
	                 <div class="text-center"> @include("msg.msg") </div>
	                 
	                 <h6 class='heading'>Get Report</h6>	                 
	                 <form action="{{ route('application.get.report') }}" method="GET" class='d-flex justify-content-between'>
	                     <select class="form-control" name="year">
    	                     <option value="">Select Year</option>
    	                     @foreach($years as $year)
    	                     <option value="{{ $year }}">{{ $year }}</option>
    	                     @endforeach
    	                 </select>
    	                 
    	                 <select class="form-control" name="month">
    	                     <option value="">Select Month</option>
    	                     <option value="1">Jan</option>
    	                     <option value="2">Feb</option>
    	                     <option value="3">March</option>
    	                     <option value="4">April</option>
    	                     <option value="5">May</option>
    	                     <option value="6">Jun</option>
    	                     <option value="7">July</option>
    	                     <option value="8">Aug</option>
    	                     <option value="9">Sep</option>
    	                     <option value="10">Oct</option>
    	                     <option value="11">Nov</option>
    	                     <option value="12">Dec</option>
    	                 </select>
    	                 <button type='submit' class='btn btn-primary'>GO</button>
	                 </form>
	             </div>
	             
	             <div class="col-md-3">
	             </div>
	        </div>
	    </div>
	    
		<h4 class="text-center"><?php echo date('d-F-Y', strtotime('-30 days')); ?> to <?php echo date("d-F-Y"); ?> Overview</h4>
		<div class="row text-center">
			
			<div class="col-md-4 single">
				<div class="heading">
					<h6>Total Item Selling</h6>
				</div>

				{{ $analytics[0] }}
			</div>

			<div class="col-md-4 single">
				<div class="heading">
					<h6>Total Item Cost</h6>
				</div>

				{{ $analytics[1] }}
			</div>

			<div class="col-md-4 single">
				<div class="heading">
					<h6>Total Profit</h6>
				</div>

				{{ $analytics[2] }}
			</div>

		</div>
	</div> 
	<!-- dashboard data end here -->
	@endif


@endsection

@push('backendCSS')
<style type="text/css">
    .get_report form select{
        margin-right:10px;
    }
    .get_report form{
        margin: 30px 0px 70px 0px;
    }
    
    .get_report .heading{
        text-align: center;
        text-transform: uppercase;
        font-weight: bold;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }


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