<li class="nav-item">
  @if(\Auth::user()->role->slug =='hygiene')
    <a href="{{ route('hygiene.inspection.submitted.pdf') }}" class="nav-link" target="_blank">
      <i class="far fa-circle nav-icon"></i>
      <p>PDF</p>
    </a>
  @endif
  @if(\Auth::user()->role->slug =='site-manager')
  <a href="{{ route('sitemanager.inspection.submitted.pdf') }}" class="nav-link" target="_blank">
    <i class="far fa-circle nav-icon"></i>
    <p>PDF</p>
  </a>
  @endif
</li>

  <li class="nav-item">
    @if(\Auth::user()->role->slug =='hygiene')
    <a href="{{ route('hygiene.inspection.submitted.excel') }}" class="nav-link" target="_blank">
      <i class="far fa-circle nav-icon"></i>
      <p>Excel</p>
    </a>
    @endif
    @if(\Auth::user()->role->slug =='site-manager')
    <a href="{{ route('sitemanager.inspection.submitted.excel') }}" class="nav-link" target="_blank">
      <i class="far fa-circle nav-icon"></i>
      <p>Excel</p>
    </a>
    @endif
  </li>