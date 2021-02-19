<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title"><strong>{{ $branch->name }}</strong></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0" style="display: block;">
          {{-- new --}}
          <div class="nav-tabs-custom mt-3" style="padding: 20px">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#email" data-toggle="tab" aria-expanded="false">Email</a></li>
              <li class="actived"><a href="#address" data-toggle="tab" aria-expanded="true">Address</a></li>
              <li class="actived"><a href="#phone" data-toggle="tab" aria-expanded="true">Phone</a></li>
              <li class="actived"><a href="#fax" data-toggle="tab" aria-expanded="true">Fax</a></li>

            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="email">
                <b>{{ $branch->email }}</b>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="address">
                {{ $branch->address}}
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="phone">
                {{ $branch->phone }}
              </div>
              <!-- /.tab-pane -->

              <!-- /.tab-pane -->
              <div class="tab-pane" id="fax">
                {{ $branch->fax }}
              </div>
              <!-- /.tab-pane -->
            </div>
          </div>
          
        </div>
        <!-- /.card-body -->
      </div>
</div>