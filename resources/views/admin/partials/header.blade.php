<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link click_head" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{ ( Route::currentRouteName() == 'admin.dashboard' ) ? 'show-item' : '' }}">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link" style="cursor:pointer;color: black;">{{ auth()->user()->en_name }}</a>
        </li>
        <li class="nav-item">
            <div class="dropdown">
                <a class="nav-link" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-th" aria-hidden="true"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item {{ ( Route::currentRouteName() == 'admin.change.pass' ) ? 'active' : '' }}" href="{{route('admin.change.pass')}}"><i class="fa fa-key mr-2" aria-hidden="true"></i>Change Password</a>
                  <a class="dropdown-item {{ ( Route::currentRouteName() == 'logout' ) ? 'active' : '' }}" onclick="return confirm('Are you sure want to logout?')" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-slide="true" role="button">
            </a>
        </li>
    </ul>   
</nav>