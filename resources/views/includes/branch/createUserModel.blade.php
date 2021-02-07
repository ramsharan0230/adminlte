<div class="modal fade" id="modal-create-user" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="form" action="{{ route('senioroperationmanager.branch.user.store') }}" method="POST">
            @csrf
            <div class="modal-header">
            <h4 class="modal-title">Add New User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{$error}}</div>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="hidden" id="branch_id" name="branch_id">
                            <label for="fullname">Name</label>
                            <input type="text" class="form-control form-control-sm" id="fullname" name="fullname" placeholder="Name..." value="{{ old('fullname') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="role_id">Roles</label>
                            <select name="role_id" id="role_id" class="form-control form-control-sm" >
                                <option value="" disabled selected> Choose Role</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control form-control-sm" id="address" name="address" placeholder="Address..." value="{{ old('address') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" class="form-control form-control-sm" name="phone" placeholder="Phone..." value="{{ old('phone') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Email..." value="{{ old('email') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Passwored..." value="{{ old('password') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password_confirmation">Conform Password</label>
                            <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" placeholder="Conform Password..." value="{{ old('password_confirmation') }}">
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>