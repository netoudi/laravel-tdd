<div class="collapse navbar-collapse" id="app-navbar-collapse">
    <!-- Left Side Of Navbar -->
    <ul class="nav navbar-nav">
        @can('access_categories')
            <li><a href="{{ route('admin.categories.index') }}">Categories</a></li>
        @endcan
        @can('access_tags')
            <li><a href="{{ route('admin.tags.index') }}">Tags</a></li>
        @endcan
        @can('access_posts')
            <li><a href="{{ route('admin.posts.index') }}">Posts</a></li>
        @endcan
        @can('access_users')
            <li><a href="{{ route('admin.users.index') }}">Users</a></li>
        @endcan
        @can('access_roles')
            <li><a href="{{ route('admin.roles.index') }}">Roles</a></li>
        @endcan
        @can('access_permissions')
            <li><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>
        @endcan
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (!Auth::guest())
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                </ul>
            </li>
        @endif
    </ul>
</div>
