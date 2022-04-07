<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item nav-dropdown">
  <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-database"></i> Data</a>
  <ul class="nav-dropdown-items">
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('document') }}'><i class='nav-icon la la-folder'></i> Documents</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('keyword') }}'><i class='nav-icon la la-tag '></i> Keywords</a></li>
  </ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon la la-terminal'></i> Logs</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-user'></i> Users</a></li>