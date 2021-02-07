<div class="col-sm-3">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title"><strong>{{ $branch->name }}</strong></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0" style="display: block;">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item active">
              <a href="#" class="nav-link">
                <i class="fas fa-inbox"></i> Email
                <span class="float-right">{{ $branch->email }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-envelope"></i> Address
                <span class="float-right"> {{ $branch->address }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-phone"></i> Phone
                <span class="float-right"> {{ $branch->phone }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-fax"></i> Fax
                <span class="float-right"> {{ $branch->fax }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-address-card"></i> Main Branch
                <span class="float-right"> {{ $branch->mainOffice->name }}</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
</div>