@extends('Backend.layouts.master')

@section('content')      
@include('Backend.layouts.partials.sidebar')

<!-- yield content here -->
<div class="col-md-12 grid-margin">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <h4 class="card-title mb-0">My Profile</h4>
      </div>
      <br>
      @include('msg.msg')
      <div class="table-responsive">
        <table class="table table-striped table-hover">
         
          <tbody>
            <tr>
              <th>Name</th>
              <td>{{ Auth::user()->name }}</td>
            </tr>

            <tr>
              <th>Email</th>
              <td>{{ Auth::user()->email }}</td>
            </tr>

            <tr>
              <th>Address</th>
              <td>{{ Auth::user()->address }}</td>
            </tr>
            
            <tr>
              <td>
                <button class="showProfileEditModal btn btn-primary btn-sm" title="Update Profile">
                  Edit Profile
                </button>
                <button class="showPasswordUpdateModal btn btn-info btn-sm" title="Change Password">
                  Change Password
                </button>
              </td>
              
              <td></td>
            </tr>          
          </tbody>
        </table>
      </div>

      <!-- profile edit modal start from here -->
            <div class="modal fade" id="profileEditModal" tabindex="-1" role="dialog" aria-labelledby="profileEditModal_label" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="profileEditModal_label">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    
                    <div class="row">
                      <div class="col-md-12">
                        <form action="{{ route('application.profile.update', Auth::user()->id) }}" method="POST">
                          @csrf
                          @method("PUT")
                          <div class="form-group">
                            <label for="name">Name</label>
                            <br>
                            <input name="name" type="text" class="form-control" value="{{ Auth::user()->name }}">
                          </div>
                          <div class="form-group">
                            <label for="email">Email address</label>
                            <br>
                            <input name="email" type="email" class="form-control" value="{{ Auth::user()->email }}">
                          </div>
                          <div class="form-group">
                            <label for="address">Address</label>
                            <br>
                            <input name="address" type="text" class="form-control" value="{{ Auth::user()->address }}">
                          </div>
                          <button name="submit" type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>
            <!-- profile edit modal end from here -->

            <!-- profile edit modal start from here -->
            <div class="modal fade" id="passwordChangeModal" tabindex="-1" role="dialog" aria-labelledby="passwordChangeModal_label" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="passwordChangeModal_label">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    
                    <div class="row">
                      <div class="col-md-12">
                        <form action="{{ route('application.passwordChange') }}" method="POST">
                          @csrf
                          <input type="hidden" name="profile_id" value="{{ Auth::user()->id }}">
                          <div class="form-group">
                            <label>Current Password</label>
                            <br>
                            <input type="password" name="current_password" placeholder="Enter current passowrd" class="form-control">
                          </div>

                          <div class="form-group">
                            <label>New Password</label>
                            <br>
                            <input type="password" name="password" placeholder="Enter new passowrd" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>New Password</label>
                            <br>
                            <input type="password" name="password_confirmation" placeholder="Enter confirm passowrd" class="form-control">
                          </div>
                          
                          <input type="submit" name="submit" value="Change" class="btn btn-primary btn-sm">
                        </form>
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer"></div>
                </div>
              </div>
            </div>
            <!-- profile edit modal end from here -->
      
    </div>
  </div>
</div>

@endsection

@push("adminScripts")
<script type="text/javascript">
  $(document).ready(function(){
    //show profile edit modal
    $(".showProfileEditModal").on("click", function(){
      $("#profileEditModal").modal("show")
    });

    //show password change modal
    $(".showPasswordUpdateModal").on("click", function(){
      $("#passwordChangeModal").modal("show")
    });

  })
</script>
@endpush