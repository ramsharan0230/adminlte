<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-list"></i>
      <p>
        Managers
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('senioroperationmanager.user') }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Senior Operation Managers</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('senioroperationmanager.site-manager') }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Site Managers</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('senioroperationmanager.hygiene') }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Hygiene Managers</p>
        </a>
      </li>

    </ul>
  </li>