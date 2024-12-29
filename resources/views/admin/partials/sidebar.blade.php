<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #4B6352 !important;">
    @php
        $segment2 = request()->segment(2);
        $segment3 = request()->segment(3);
    @endphp

    <!-- Brand Logo -->
    <a href="javascript:void(0);" class="brand-link" style="background: #4B6352 !important;">
        <div class="ml-3">
            <img src="{{asset('assets/admin/logo.png')}}" width="90" class="ml-5 mr-5 side_logo">
        </div>
    </a>
   
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                    $user = Auth::user();
                    $permissions = $user->roles->flatMap(function ($role) {
                        return $role->permissions;
                    }); 
                    $permission = $permissions->pluck('name')->toArray();
                @endphp
                <li class="nav-item {{ ($segment2 == 'dashboard') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="{{route('admin.dashboard')}}" class="nav-link {{ ( Route::currentRouteName() == 'admin.dashboard' ) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tachometer" aria-hidden="true"></i>
                        <p>{{ __('Dashboard')}}</p>
                    </a>
                </li>
                @if($user->hasRole('Admin'))
                    <li class="nav-item {{ ($segment2 == 'users') ? 'menu-is-opening menu-open' : '' }}" >
                        <a href="{{route('admin.user.index')}}" class="nav-link {{ ( Route::currentRouteName() == 'admin.user.index' ) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                            <p>{{ __('Users')}}</p>
                        </a>
                    </li>  
                    <li class="nav-item {{ ($segment2 == 'roles') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="{{route('admin.role.index')}}" class="nav-link {{ ( Route::currentRouteName() == 'admin.role.index' ) ? 'active' : '' }}">
                            <i class="nav-icon fa fa-list" aria-hidden="true"></i>
                            <p>{{ __('Role')}}</p>
                        </a>
                    </li>  
                    <li class="nav-item {{ ($segment2 == 'permission') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="{{route('admin.permission.index')}}" class="nav-link {{ ( Route::currentRouteName() == 'admin.permission.index' ) ? 'active' : '' }}">
                            <i class="nav-icon far fa-copy" aria-hidden="true"></i>
                            <p>{{ __('Permission')}}</p>
                        </a>
                    </li>  
                @endif
                <li class="nav-item {{ ($segment2 == 'supplier') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="{{route('admin.supplier.index')}}" class="nav-link {{ ( Route::currentRouteName() == 'admin.supplier.index' ) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-list" aria-hidden="true"></i>
                        <p>{{ __('Supplier')}}</p>
                    </a>
                </li>  
                <li class="nav-item {{ ($segment2 == 'customers') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="{{route('admin.customer.index')}}" class="nav-link {{ ( Route::currentRouteName() == 'admin.customer.index' ) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-customer" aria-hidden="true"></i>
                        <p>{{ __('Customers')}}</p>
                    </a>
                </li>  
            </ul>
        </nav>
    </div>
</aside>