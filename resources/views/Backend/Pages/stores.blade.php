@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')
      
    <!-- yield content here -->
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h4 class="card-title mb-0">All Stores</h4>
          </div>
          <p class="card-description">In this page you are showing all store</p>

          @include('msg.msg')

          <div>
            @if(!$stores->isEmpty())
              <b>Total Store:</b> {{ $stores->total() }}
            @endif
          </div>

          <div class="table-responsive">
            <table class="table table-striped table-hover text-center">
              <thead>
                <tr>
                  <th>SL.</th>
                  <th>Store Name</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if(!$stores->isEmpty())
                @foreach($stores as $key=>$store)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $store->store_name }}</td>
                  <td>{{ $store->created_at->format('Y-m-d h:m') }}</td>

                  <td>
                    <button modalid='{{ $store->id }}' class="showStoreEditModal btn btn-primary btn-sm">
                      <i class="fas fa-edit"></i>
                    </button>

                      <div class="modal fade" id="storeEditModal-{{ $store->id }}" tabindex="-1" role="dialog" aria-labelledby="labelStore-{{ $store->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="labelStore-{{ $store->id }}">Edit Store</h5>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('application.stores.update', $store->id) }}"
                                  class="text-left" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                  <label>Store Name</label>
                                  <br>
                                  <input type="text" name="store_name" value="{{ $store->store_name }}" 
                                    class="form-control">
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    <!-- store deleting code start from here -->
                      <form style="display:none;" id="delete-form-{{ $store->id }}" 
                        action="{{ route('application.stores.destroy', $store->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                      </form>

                      <button type="button" class="btn btn-danger btn-sm"
                        onclick="if(confirm('Are you sure to Delete?\n\nIt will delete all the associated data OK!')){
                          event.preventDefault();
                          document.getElementById('delete-form-{{ $store->id }}').submit();
                        }else{
                          event.preventDefault();
                        }"
                      >
                        <i class="far fa-trash-alt"></i>
                      </button>

                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
          {!! $stores->render() !!}
        </div>
      </div>
    </div>

@endsection