<div class="modal fade" id="modal-edit-branch" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form class="form" action="{{ route('senioroperationmanager.branch.update') }}" method="POST">
            @csrf
            <div class="modal-header">
            <h4 class="modal-title">Add New Branch</h4>
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
                            <input type="hidden" name="editId" class="form-control form-control-sm" id="editId">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-sm" id="editName" name="office_name" placeholder="Name..." value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="editMainOfficeId">Main Office</label>
                            <select name="main_office_id" id="editMainOfficeId" class="form-control form-control-sm" >
                                <option value=""> Choose Main office</option>
                                @forelse ($main_branches as $item)
                                    <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                @empty
                                    <option value=""> No Main Office Found!!</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control form-control-sm" id="editAddress" name="address" placeholder="Address..." value="{{ old('address') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="editPhone" class="form-control form-control-sm" name="phone" placeholder="Phone..." value="{{ old('phone') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control form-control-sm" id="editEmail" name="email" placeholder="Email..." value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="fax">Fax</label>
                            <input type="text" class="form-control form-control-sm" id="editEditFax" name="fax" placeholder="Fax..." value="{{ old('fax') }}">
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