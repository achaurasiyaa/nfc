<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('team_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.teams.index") }}" class="nav-link {{ request()->is('admin/teams') || request()->is('admin/teams/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-users nav-icon">

                                    </i>
                                    {{ trans('cruds.team.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('item_access')
                <li class="nav-item">
                    <a href="{{ route("admin.items.index") }}" class="nav-link {{ request()->is('admin/items') || request()->is('admin/items/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        Add Item
                        {{-- {{ trans('cruds.asset.title') }} --}}
                    </a>
                </li>
            @endcan
            @can('worker_access')
                <li class="nav-item">
                    <a href="{{ route("admin.worker.index") }}" class="nav-link {{ request()->is('admin/worker') || request()->is('admin/worker/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">
                        </i>
                        Add Worker
                    </a>
                </li>
            @endcan
            @can('vendor_access')
            <li class="nav-item">
                <a href="{{ route("admin.vendor.index") }}" class="nav-link {{ request()->is('admin/vendor') || request()->is('admin/vendor/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-cogs nav-icon">

                    </i>
                    Add Vendor
                </a>
            </li>
        @endcan
            {{-- @can('stock_access')
                <li class="nav-item">
                    <a href="{{ route("admin.stocks.index") }}" class="nav-link {{ request()->is('admin/stocks') || request()->is('admin/stocks/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        {{ trans('cruds.stock.title') }}
                    </a>
                </li>
            @endcan --}}
            @can('transaction_access')
                <li class="nav-item">
                    <a href="{{ route("admin.transactions.index") }}" class="nav-link {{ request()->is('admin/transactions') || request()->is('admin/transactions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-cogs nav-icon">

                        </i>
                        {{ trans('cruds.transaction.title') }}
                    </a>
                </li>
            @endcan
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
