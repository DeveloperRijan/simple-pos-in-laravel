@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')

<!-- yield content here -->
<div class="col-md-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h4 class="card-title mb-0">Choose Store to go next...</h4>
      </div>
      <br>
      @include('msg.msg')
      
      <div class="table-responsive">
        <table class="table table-striped table-hover text-center">
         <thead>
             <th>SN</th>
             <th>Store Name</th>
             <th>Go</th>
        </thead>
          <tbody>
             @if(!$getAllStores->isEmpty())
             @foreach($getAllStores as $key=>$getAllStore)
             <tr>
                 <td>{{ $key+1 }}</td>
                 <td>{{ $getAllStore->store_name }}</td>
                 <td>
                  <a href='{{ route('application.getDataByStore', $getAllStore->id) }}' class='btn btn-primary -btn-sm'>GO</a>
                 </td>
            </tr>
            @endforeach
            @endif
            
          </tbody>
        </table>
      </div>

      
    </div>
  </div>
</div>

@endsection

@push("adminScripts")

@endpush