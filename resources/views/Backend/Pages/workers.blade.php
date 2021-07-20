@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')

<!-- yield content here -->
<div class="col-md-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h4 class="card-title mb-0">Workers List</h4>
      </div>
      <p>You are showing all active workers</p>
      <div>
        <h6>Total Worker: {{ count($workers) }}</h6>
      </div>
      @include('msg.msg')
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>SN.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Address</th>
              <th>Created at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @if(!$workers->isEmpty())
            @foreach($workers as $key=>$worker)
            <tr>
              <td>{{  $key+1 }}</td>
              <td>{{ $worker->name }}</td>
              <td>{{ $worker->email }}</td>
              <td>{{ $worker->address }}</td>
              <td>{{ $worker->created_at->format('Y-m-d h:m') }}</td>
              <td>
                <button modalid="{{ $worker->id }}" class="showWorkerEditModal btn btn-info btn-sm" title="Edit Worker Info.">
                  <i class="fas fa-edit"></i>
                </button>
                
                <!-- worker edit modal start from here -->
                <div class="modal fade" id="workerEditModal-{{ $worker->id }}" tabindex="-1" role="dialog" aria-labelledby="workerEditModalLabel-{{ $worker->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="workerEditModalLabel-{{ $worker->id }}">Edit Woker Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                        <div class="row">
                          <div class="col-md-12">
                            <form action="{{ route('application.workers.update', $worker->id) }}" method="POST">
                              @csrf
                              @method("PUT")
                              <div class="form-group">
                                <label for="worker_name">Worker Name</label>
                                <br>
                                <input name="worker_name" type="text" class="form-control" value="{{ $worker->name }}">
                              </div>
                              <div class="form-group">
                                <label for="worker_email">Email address</label>
                                <br>
                                <input name="worker_email" type="email" class="form-control" value="{{ $worker->email }}">
                              </div>
                              <div class="form-group">
                                <label for="worker_email">Worker address</label>
                                <br>
                                <input name="worker_address" type="text" class="form-control" value="{{ $worker->address }}">
                              </div>
                              <div class="form-group">
                                <label for="worker_password_new">New Password</label>
                                <br>
                                <input name="worker_password_new" type="password" class="form-control" placeholder="Enter update password...">
                                <br>
                                <small style="color: red">If you want to update worker password then enter new password ok</small>
                              </div>
                              <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                          </div>
                        </div>

                      </div>
                      <div class="modal-footer">
                        
                      </div>
                    </div>
                  </div>
                </div>
                <!-- worker edit modal end from here -->
                
                <!-- worker delete code start from here -->
                  <form style="display:none;" id="delete-form-{{ $worker->id }}" 
                    action="{{ route('application.workers.destroy', $worker->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                  </form>

                  <button type="button" class="btn btn-danger btn-sm"
                    onclick="if(confirm('Are you sure to Delete?')){
                      event.preventDefault();
                      document.getElementById('delete-form-{{ $worker->id }}').submit();
                    }else{
                      event.preventDefault();
                    }"
                  >
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <!-- worker delete code end from here -->
              </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="5">No Worker Found</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection