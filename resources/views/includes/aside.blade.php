<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Aa24Inspect</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ \Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            @if(\Auth::user()->role->slug =='senior-operation-manager')
              @include('includes.dashboard.senior-operation-manager')
            @endif
            
            @if(\Auth::user()->role->slug =='operation-manager')
              @include('includes.dashboard.operation-manager')
            @endif

            @if(\Auth::user()->role->slug =='site-manager')
              @include('includes.dashboard.site-manager')')
            @endif

            @if(\Auth::user()->role->slug =='hygiene')
              @include('includes.dashboard.hygiene')
            @endif
{{-- inspection list --}}
          
            @if(\Auth::user()->role->slug =='senior-operation-manager')
              @include('includes.inspections.senior-operation-manager-inspection')
            @endif
            
            @if(\Auth::user()->role->slug =='operation-manager')
              @include('includes.inspections.operation-manager-inspection')
            @endif

            @if(\Auth::user()->role->slug =='site-manager')
              @include('includes.inspections.site-manager-inspection')
            @endif

            @if(\Auth::user()->role->slug =='hygiene')
              @include('includes.inspections.hygiene-inspection')
            @endif
{{-- inspection list end --}}

            


          @if(\Auth::user()->role->slug =='hygiene')
          @include('includes.hygienes')
          @endif
          @if(\Auth::user()->role->slug =='site-manager')
          @include('includes.site-managers')
          @endif
          @if(\Auth::user()->role->slug =='operation-manager')
          @include('includes.operation-managers')
          @endif
          @if(\Auth::user()->role->slug =='senior-operation-manager')
          @include('includes.senior-operation-managers')
          <li class="nav-header"><strong>Branches</strong> </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('senioroperationmanager.branch') }}" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Branches
              </p>
            </a>
            
          </li>
          @endif
          
          <li class="nav-header"><strong>Reports</strong> </li>
          <li class="nav-item">
              <a href="{{ route('inspection.report.pdf', Auth::user()->branch->id) }}" class="nav-link" target="_blank">
                <i class="far fa-circle nav-icon"></i>
                <p>PDF</p>
              </a>
          </li>

          <li class="nav-item">
              <a href="{{ route('inspection.report.excel', Auth::user()->branch->id) }}" class="nav-link" target="_blank">
                <i class="far fa-circle nav-icon"></i>
                <p>Excel</p>
              </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>